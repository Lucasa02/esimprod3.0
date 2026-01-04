<div id="select-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm bg-slate-900/40">
    
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-2xl dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
            
            <div class="flex items-center justify-between p-6 border-b dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 bg-[#1b365d]/10 rounded-xl">
                        <svg class="w-6 h-6 text-[#1b365d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white leading-none">
                            Project Credits
                        </h3>
                        <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider">The Team Behind This Project</p>
                    </div>
                </div>
                <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors" data-modal-toggle="select-modal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    @php
                        $credits = [
                            ['id' => 1, 'role' => 'EXECUTIVE PRODUCER', 'names' => 'Hari Setiya, I Gede Mustito, I Ketut Sutakariana'],
                            ['id' => 2, 'role' => 'PROJECT LEADER', 'names' => 'Akbar Laksana'],
                            ['id' => 3, 'role' => 'SYSTEM ANALYST', 'names' => 'Widya Setiyawan, Lilik Susanto, Yusuf Supriyanto, Akbar Laksana'],
                            ['id' => 4, 'role' => 'PROJECT MANAGER', 'names' => 'Saguh Wiyono, Akmal Rahim, Rizqi Akbar'],
                            ['id' => 5, 'role' => 'LEAD PROGRAMMER', 'names' => 'Saguh Wiyono, Akmal Rahim, Rizqi Akbar, M. Galih Katon Bagaskara'],
                            ['id' => 6, 'role' => 'PROGRAMMER', 'names' => 'M. Maireza, Muhammad Ichsan Fadillah, Arif Junaidi, Muhammad Hafiz Ansori'],
                            ['id' => 7, 'role' => 'INTERFACE DESIGNER', 'names' => 'Akbar Laksana, M. Fajrianoor, M. Eryash Nurhadiarta, Abdi Fazar, Muhammad Widigda Pratama'],
                            ['id' => 8, 'role' => 'PHOTOGRAPHER', 'names' => 'Yusuf Haikal'],
                        ];
                    @endphp

                    @foreach (array_chunk($credits, 4) as $column)
                        <ul class="space-y-3">
                            @foreach ($column as $item)
                                <li>
                                    <input type="radio" id="job-{{ $item['id'] }}" name="job" value="job-{{ $item['id'] }}" class="hidden peer" required />
                                    <label for="job-{{ $item['id'] }}"
                                        class="group flex items-center justify-between w-full p-4 text-gray-600 bg-white border border-gray-200 rounded-xl cursor-pointer dark:bg-gray-800 dark:border-gray-700 peer-checked:border-[#1b365d] peer-checked:bg-[#1b365d]/[0.03] hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-300 shadow-sm">
                                        <div class="block">
                                            <div class="w-full text-[10px] font-black uppercase tracking-[0.15em] text-[#1b365d] mb-1 opacity-80 group-hover:opacity-100 transition-opacity">
                                                {{ $item['role'] }}
                                            </div>
                                            <div class="w-full text-sm font-semibold text-gray-800 dark:text-gray-200 group-hover:text-black dark:group-hover:text-white transition-colors">
                                                {{ $item['names'] }}
                                            </div>
                                        </div>
                                        <div class="opacity-0 peer-checked:group-[]:opacity-100 transition-opacity">
                                            <div class="w-2 h-2 rounded-full bg-[#1b365d]"></div>
                                        </div>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach

                </div>
            </div>

            <div class="p-6 border-t dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 rounded-b-2xl flex justify-center">
                <p class="text-[11px] text-gray-400 font-medium tracking-widest uppercase">
                    &copy; {{ date('Y') }} Production Team &bull; ESIMPROD TVRI KALIMANTAN SELATAN
                </p>
            </div>
        </div>
    </div>
</div>