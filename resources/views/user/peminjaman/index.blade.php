@extends('layouts.user.main')

@section('title', 'Peminjaman')

@section('content')
  {{-- Custom Styles for Smooth Animations --}}
  <style>
    /* Keyframes untuk Entrance */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Keyframes untuk Item Baru Scan */
    @keyframes highlightRow {
      0% { background-color: rgba(59, 130, 246, 0.1); transform: scale(0.98); }
      50% { background-color: rgba(59, 130, 246, 0.2); transform: scale(1.01); }
      100% { background-color: transparent; transform: scale(1); }
    }

    /* Utility Classes */
    .animate-enter {
      opacity: 0; /* Mulai invisible */
      animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }

    /* Row Animation Classes */
    .new-row-animation {
      animation: highlightRow 0.8s ease-out forwards;
    }

    .delete-row-animation {
      transition: all 0.4s ease;
      opacity: 0;
      transform: translateX(-20px);
      background-color: #fee2e2 !important; /* Light red dark mode handled via JS/CSS var if needed */
    }

    /* Soften Input Focus */
    input:focus, select:focus {
      transition: all 0.3s ease;
      transform: translateY(-1px);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    /* Loading Screen Blur */
    #loadingScreen {
      backdrop-filter: blur(8px);
      transition: opacity 0.3s ease-in-out;
    }
  </style>

  <div class="overflow-x-auto shadow-md sm:rounded-lg mt-2">

    {{-- 1. Profil (Animate Enter) --}}
    <div class="animate-enter">
        <x-peminjam-profile></x-peminjam-profile>
    </div>


    {{-- 2. Input Data (Animate Enter Delay) --}}
    <div class="relative overflow-auto bg-white dark:bg-gray-800 sm:rounded-lg animate-enter delay-100">
      <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
        <div class="w-full md:w-1/2">
          <form class="col-span-1" id="form">
            <div class="relative group">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none transition-colors group-focus-within:text-blue-500">
                <i class="fa-solid fa-file-lines text-gray-500 dark:text-gray-400"></i>
              </div>
              <input type="text" id="nomor-surat" name="nomor_surat"
                class="w-full pl-10 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-all duration-300"
                placeholder="Masukkan Surat Tugas">
              @error('nomor_surat')
                <small class="text-red-500 text-sm animate-pulse"> {{ $message }}</small>
              @enderror
            </div>
          </form>
        </div>
        <div
          class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
          <div class="flex items-center w-full space-x-3 md:w-auto">
            <div id="date-range-picker" class="flex items-center">
              <small class="mx-4 text-gray-500">Dari</small>
              <div class="relative group">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none group-focus-within:text-blue-500">
                  <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 transition-colors" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                  </svg>
                </div>
                <input id="tanggal-penggunaan" name="start" type="date" readonly
                  class="w-full pl-10 p-2 text-sm border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-all duration-300"
                  placeholder="Tanggal peminjaman" />
              </div>
              <small class="mx-4 text-gray-500">Sampai</small>
              <div class="relative group">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none group-focus-within:text-blue-500">
                  <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 transition-colors" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                  </svg>
                </div>
                <input id="tanggal-kembali" name="end" type="date"
                  class="w-full pl-10 p-2 text-sm border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-all duration-300"
                  placeholder="Tanggal pengembalian" onclick="this.showPicker();" />
              </div>
            </div>

            {{-- peruntukan --}}
            <div>
              <select id="peruntukan" name="peruntukan"
                class="w-full p-2 text-sm border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-all duration-300 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600">
                <option value="" selected>-- Pilih Peruntukan --</option>
                @foreach ($peruntukanData as $peruntukan)
                  <option value="{{ $peruntukan->id }}">{{ $peruntukan->peruntukan }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- 3. List Barang (Animate Enter Delay) --}}
    <div class="max-h-72 overflow-y-auto animate-enter delay-200">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
          <tr>
            <th scope="col" class="p-4">No</th>
            <th scope="col" class="px-6 py-3">Nama Barang</th>
            <th scope="col" class="px-6 py-3">Merk</th>
            <th scope="col" class="px-6 py-3">No Seri</th>
            <th scope="col" class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
          @if (session('borrowed_items'))
            @foreach (session('borrowed_items') as $index => $item)
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200"
                data-item-id="{{ $item['uuid'] }}" id="item-{{ $item['uuid'] }}">
                <td class="w-4 p-4">
                  <div class="flex items-center">
                    <p>{{ $index + 1 }}</p>
                  </div>
                </td>
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                  <div class="ps-2">
                    <div class="text-base font-semibold">{{ $item['name'] }}</div>
                  </div>
                </th>
                <td class="px-6 py-4">{{ $item['merk'] }}</td>
                <td class="px-6 py-4">
                  <div class="flex items-center">{{ $item['serial_number'] }}</div>
                </td>
                <td class="px-6 py-4">
                  <a href="#" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                    data-uuid="{{ $item['uuid'] }}"
                    class="text-blue-600 dark:text-blue-500 hover:text-red-600 hover:scale-110 transform transition-transform duration-200 inline-block">
                    <i class="fa-regular fa-trash-can fa-lg ml-3"></i>
                  </a>
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>

    <x-peminjaman-popup></x-peminjaman-popup>

  </div>

  {{-- 4. Buttons (Animate Enter Delay) --}}
  <div class="flex justify-center space-x-2 mt-4 mb-16 animate-enter delay-300">
    <a href="{{ route('user.option') }}">
      <button type="button"
        class="text-white bg-blue-900 hover:bg-blue-800 hover:shadow-lg hover:-translate-y-0.5 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 transition-all duration-300">
        Kembali
      </button>
    </a>
    <button data-modal-target="save-modal" data-modal-toggle="save-modal" type="button" id="saveButton"
      class="text-white bg-blue-900 hover:bg-blue-800 hover:shadow-lg hover:-translate-y-0.5 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 transition-all duration-300">
      Simpan
    </button>
  </div>

  {{-- Loading Screen --}}
  <div id="loadingScreen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="text-center transform transition-transform scale-100">
      <div class="w-16 h-16 border-4 border-t-blue-500 border-gray-300 rounded-full animate-spin mx-auto shadow-xl"></div>
      <p class="text-white mt-4 text-sm font-medium tracking-wide animate-pulse">Menyimpan data penggunaan...</p>
    </div>
  </div>

  <script>
    // Constants and Configuration
    const CONFIG = {
      API_ENDPOINTS: {
        SCAN_ITEM: '/user/peminjaman/scan',
        REMOVE_ITEM: '/user/peminjaman/remove/',
        STORE_LOAN: '/user/peminjaman/store'
      },
      TIMEOUT_DURATION: 2000,
      SCANNER_INPUT_TIMEOUT: 100
    };

    // Utility Functions
    const Utils = {
      getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      },
      formatDate(date) {
        return date.toISOString().split('T')[0];
      },
      showToast(toastId, message) {
        const toast = document.getElementById(toastId);
        const textEl = toast.querySelector('.text-sm');
        textEl.textContent = message;
        
        // Animasi Masuk Toast
        toast.style.display = 'flex';
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(20px)';
        toast.style.transition = 'all 0.3s ease-out';
        
        requestAnimationFrame(() => {
             toast.style.opacity = '1';
             toast.style.transform = 'translateY(0)';
        });

        setTimeout(() => {
          // Animasi Keluar Toast
          toast.style.opacity = '0';
          toast.style.transform = 'translateY(-20px)';
          setTimeout(() => { toast.style.display = 'none'; }, 300);
        }, CONFIG.TIMEOUT_DURATION);
      }
    };

    // Modal Handling
    const ModalHandler = {
      init() {
        const modalTriggers = document.querySelectorAll('[data-modal-toggle="popup-modal"]');
        modalTriggers.forEach(trigger => {
          trigger.addEventListener('click', () => {
            const uuid = trigger.getAttribute('data-uuid');
            document.getElementById('modal-uuid').value = uuid;
          });
        });
      },
      confirmDelete() {
        const uuid = document.getElementById('modal-uuid').value;
        ItemManager.removeItem(uuid);
      }
    };

    // Item Management
    const ItemManager = {
      addItemToTable(item) {
        const tbody = document.querySelector('table tbody');
        const rowCount = tbody.children.length + 1;
        const tr = document.createElement('tr');

        // Added 'new-row-animation' class
        tr.className =
          'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200 new-row-animation';
        tr.dataset.itemId = item.uuid;
        tr.id = `item-${item.uuid}`; // Ensure ID is set for scrolling
        
        tr.innerHTML = `
            <td class="w-4 p-4">
                <div class="flex items-center">
                    <p>${rowCount}</p>
                </div>
            </td>
            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                <div class="ps-2">
                    <div class="text-base font-semibold">${item.name}</div>
                </div>
            </th>
            <td class="px-6 py-4">${item.merk}</td>
            <td class="px-6 py-4">
                <div class="flex items-center">${item.serial_number}</div>
            </td>
            <td class="px-6 py-4">
                <a href="#" onclick="ItemManager.removeItem('${item.uuid}')" 
                   class="text-blue-600 dark:text-blue-500 hover:text-red-600 hover:scale-110 transform transition-transform duration-200 inline-block">
                    <i class="fa-regular fa-trash-can fa-lg ml-3"></i>
                </a>
            </td>
        `;

        // Prepend to top or Append? Typically append for lists
        tbody.appendChild(tr); 
        
        // Scroll to new item gently
        setTimeout(() => {
            tr.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 100);

        this.updateRowNumbers();
      },

      removeItem(uuid) {
        fetch(`${CONFIG.API_ENDPOINTS.REMOVE_ITEM}${uuid}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': Utils.getCsrfToken()
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              const tbody = document.querySelector('table tbody');
              const row = tbody.querySelector(`tr[data-item-id="${uuid}"]`);
              
              if (row) {
                // Add exit animation class
                row.classList.add('delete-row-animation');
                
                // Wait for animation to finish before removing from DOM
                setTimeout(() => {
                    if (row.parentNode) {
                        tbody.removeChild(row);
                        this.updateRowNumbers();
                    }
                }, 400); // Matches CSS transition duration
              }
            }
          })
          .catch(console.error);
      },
      updateRowNumbers() {
        const tbody = document.querySelector('table tbody');
        Array.from(tbody.children).forEach((row, index) => {
          row.querySelector('td p').textContent = index + 1;
        });
      }
    };

    // Scanner Handler
    const ScannerHandler = {
      init() {
        let lastScanned = '';
        let lastScannedTimeout;

        document.addEventListener('keydown', (e) => {
          if (['Shift', 'Control', 'Alt'].includes(e.key)) return;

          if (e.key === 'Enter') {
            if (lastScanned) {
              this.processBarcodeInput(lastScanned);
              lastScanned = '';
              clearTimeout(lastScannedTimeout);
            }
          } else {
            lastScanned += e.key;
            clearTimeout(lastScannedTimeout);
            lastScannedTimeout = setTimeout(() => {
              lastScanned = '';
            }, CONFIG.SCANNER_INPUT_TIMEOUT);
          }
        });
      },
      processBarcodeInput(qrcode) {
        fetch(CONFIG.API_ENDPOINTS.SCAN_ITEM, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': Utils.getCsrfToken()
            },
            body: JSON.stringify({
              qrcode
            })
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              ItemManager.addItemToTable(data.item);
              Utils.showToast('toast-success-add', data.message);
            } else {
              Utils.showToast('toast-warning', data.message);
            }
          })
          .catch(console.error);
      }
    };

    // Loan Management
    const LoanManager = {
      async savePeminjaman() {
        const inputs = {
          suratTugas: document.getElementById('nomor-surat').value,
          tanggalPenggunaan: document.getElementById('tanggal-penggunaan').value,
          tanggalPengembalian: document.getElementById('tanggal-kembali').value,
          peruntukanId: document.getElementById('peruntukan').value
        };

        if (Object.values(inputs).some(value => !value)) {
          Utils.showToast('toast-danger-2', 'Mohon lengkapi semua data.');
          
          // Shake animation for form if invalid
          const formArea = document.querySelector('.relative.overflow-auto');
          formArea.classList.add('animate-[shake_0.5s_ease-in-out]');
          setTimeout(() => formArea.classList.remove('animate-[shake_0.5s_ease-in-out]'), 500);
          
          return;
        }

        const loadingScreen = document.getElementById('loadingScreen');
        loadingScreen.classList.remove('hidden');
        // Small fade in for loading
        setTimeout(() => loadingScreen.classList.remove('opacity-0'), 10);

        try {
          const response = await fetch(CONFIG.API_ENDPOINTS.STORE_LOAN, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': Utils.getCsrfToken(),
              'Accept': 'application/json'
            },
            body: JSON.stringify({
              nomor_surat: inputs.suratTugas,
              peruntukan_id: inputs.peruntukanId,
              tanggal_penggunaan: inputs.tanggalPenggunaan,
              tanggal_kembali: inputs.tanggalPengembalian
            })
          });

          const result = await response.json();

          loadingScreen.classList.add('hidden');
          loadingScreen.classList.add('opacity-0');

          if (result.success) {
            this.showSuccessModal();
          } else {
            Utils.showToast('toast-danger-2', result.message);
          }

        } catch (error) {
          console.error('Error:', error);
          loadingScreen.classList.add('hidden');
          Utils.showToast('toast-danger-2', 'Terjadi kesalahan saat menyimpan data.');
        }
      },

      showSuccessModal() {
        const successModal = document.getElementById('successModal');
        successModal.classList.remove('hidden');

        const selesaiButton = document.getElementById('successButton');
        selesaiButton.addEventListener('click', () => {
          window.location.href = '/user/peminjaman/report';
        });
      },

      initDateInputs() {
        const today = Utils.formatDate(new Date());
        const tanggalPinjam = document.getElementById('tanggal-penggunaan');
        const tanggalKembali = document.getElementById('tanggal-kembali');

        if (!tanggalPinjam.value) {
          tanggalPinjam.min = today;
          tanggalPinjam.value = today;
        }
        tanggalKembali.min = tanggalPinjam.value;

        tanggalPinjam.addEventListener('change', function() {
          tanggalKembali.min = this.value;
          // Smooth focus move
          tanggalKembali.focus();
        });
      }
    };

    // Initialize on DOM Load
    document.addEventListener('DOMContentLoaded', () => {
      ModalHandler.init();
      ScannerHandler.init();
      LoanManager.initDateInputs();

      document.getElementById('saveButton').addEventListener('click', (e) => {
        e.preventDefault();
        LoanManager.savePeminjaman();
      });

      const datepickerInput = document.getElementById('datepicker');
      if (datepickerInput) {
        new Datepicker(datepickerInput, {
          minDate: new Date(),
          todayHighlight: true
        });
      }
    });

    document.getElementById('peruntukan').addEventListener('change', function() {
      this.blur();
    });
  </script>
@endsection