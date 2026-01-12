<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }
</style>

<div id="select-modal" tabindex="-1" aria-hidden="true"
    class="hidden no-scrollbar overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-md bg-slate-900/60 transition-all duration-300">

    <div class="relative p-4 w-full max-w-5xl max-h-full">
        <div class="relative bg-white rounded-3xl shadow-2xl dark:bg-gray-900 border border-white/20 overflow-hidden">

            <div class="relative px-8 pt-8 pb-6 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div
                        class="flex-shrink-0 p-3 bg-[#1b365d] dark:bg-blue-600 rounded-2xl shadow-lg shadow-[#1b365d]/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight leading-none">
                            Project Credits
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mt-1">Professional Team &
                            Contributors</p>
                    </div>
                </div>
                <button type="button"
                    class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-400 transition-colors"
                    data-modal-toggle="select-modal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-8 pt-0">
                @php
                    $credits = [
                        [
                            'role' => 'EXECUTIVE PRODUCER',
                            'members' => [
                                ['name' => 'I Gede Mustito (V 1.0)', 'email' => ''],
                                ['name' => 'Hari Setiya (V 2.0 )', 'email' => ''],
                                ['name' => 'I Ketut Sutakariana (V 2.1 & V 3.0 )', 'email' => ''],
                            ],
                        ],
                        [
                            'role' => 'PROJECT LEADER',
                            'members' => [
                                ['name' => 'Akbar Laksana (All Version)', 'email' => 'akbarlaksana@gmail.com'],
                            ],
                        ],
                        [
                            'role' => 'SYSTEM ANALYST',
                            'members' => [
                                ['name' => 'Widya Setiyawan (V 1.0)', 'email' => ''],
                                ['name' => 'Lilik Susanto (V 2.0 )', 'email' => ''],
                                ['name' => 'Yusuf Supriyanto ( All Version)', 'email' => ''],
                                ['name' => 'Akbar Laksana ( All Version)', 'email' => 'akbarlaksana@gmail.com'],
                            ],
                        ],
                        [
                            'role' => 'PROJECT MANAGER',
                            'members' => [
                                ['name' => 'Saguh Wiyono (V 1.0)', 'email' => ''],
                                ['name' => 'Akmal Rahim (V 2.0)', 'email' => ''],
                                ['name' => 'Rizqi Akbar ( V 2.1 & V 3.0)', 'email' => ''],
                            ],
                        ],
                        [
                            'role' => 'LEAD PROGRAMMER',
                            'members' => [
                                ['name' => 'Saguh Wiyono ( V 1.0)', 'email' => ''],
                                ['name' => 'Akmal Rahim ( V 2.0)', 'email' => ''],
                                ['name' => 'Rizqi Akbar ( V 2.1)', 'email' => ''],
                                ['name' => 'M. Galih Katon Bagaskara ( V 3.0)', 'email' => 'muhammadbgss02@gmail.com'],
                            ],
                        ],
                        [
                            'role' => 'PROGRAMMER',
                            'members' => [
                                ['name' => 'M. Maireza ( V 2.0)', 'email' => ''],
                                ['name' => 'Muhammad Ichsan Fadillah ( V 2.0)', 'email' => ''],
                                ['name' => 'Arif Junaidi ( V 2.1)', 'email' => ''],
                                ['name' => 'Muhammad Hafiz Ansori ( V 3.0)', 'email' => 'hafizansori006@gmail.com'],
                            ],
                        ],
                        [
                            'role' => 'INTERFACE DESIGNER',
                            'members' => [
                                ['name' => 'Akbar Laksana ( All Version)', 'email' => 'akbarlaksana@gmail.com'],
                                ['name' => 'M. Fajrianoor ( V 1.0)', 'email' => ''],
                                ['name' => 'M. Eryash Nurhadiarta ( V 2.0)', 'email' => ''],
                                ['name' => 'Abdi Fazar ( V 3.0)', 'email' => 'abdifazar18@gmail.com'],
                                ['name' => 'Muhammad Widigda Pratama ( V 3.0)', 'email' => 'digda.108@gmail.com'],
                            ],
                        ],
                        [
                            'role' => 'PHOTOGRAPHER',
                            'members' => [['name' => 'Yusuf Haikal', 'email' => '']],
                        ],
                    ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($credits as $item)
                        <div
                            class="group p-5 bg-gray-50/50 dark:bg-gray-800/40 border border-gray-100 dark:border-gray-700 rounded-2xl hover:bg-white hover:shadow-xl hover:shadow-gray-200/50 dark:hover:shadow-none transition-all duration-300">
                            <div class="mb-3">
                                <span
                                    class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#1b365d] dark:text-blue-400 bg-[#1b365d]/5 dark:bg-blue-400/10 px-3 py-1 rounded-lg">
                                    {{ $item['role'] }}
                                </span>
                            </div>
                            <div class="flex flex-col space-y-1.5">
                                @foreach ($item['members'] as $person)
                                    <a href="mailto:{{ $person['email'] }}"
                                        class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-[#1b365d] dark:hover:text-blue-400 transition-all duration-200 flex items-center group/name">
                                        <span>{{ $person['name'] }}</span>
                                        <svg class="w-3 h-3 ml-2 opacity-0 group-hover/name:opacity-100 transition-opacity"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div
                class="p-6 bg-gray-50 dark:bg-gray-800/50 flex flex-col items-center gap-2 border-t dark:border-gray-700">
                <p class="text-[11px] text-gray-400 font-bold tracking-widest uppercase text-center">
                    &copy; TVRI STASIUN KALIMANTAN SELATAN 2022 - {{ date('Y') }}
                </p>
                <div class="h-1 w-12 bg-[#1b365d]/20 rounded-full"></div>
            </div>
        </div>
    </div>
</div>
