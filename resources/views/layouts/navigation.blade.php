<aside :class="{ 'translate-x-0': open, '-translate-x-full': !open }"
    class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
    <div class="overflow-y-auto p-0 h-full">
        <div class="flex flex-row justify-between border-gray-600 border-b">
            <!-- Logo -->
            <div class="w-6 flex items-center mb-6 mt-3">
                <span class="text-2xl font-extrabold mx-1">SITAS</span>
            </div>
            <div class="flex">
                <a href="{{ route('dashboard') }}">
                    <img width="45" src="{{ asset('logo/logo.png') }}" alt="">
                </a>
            </div>
        </div>
        <ul class="space-y-4 my-9 p-0">
            <li class=" border-gray-600 ">
                <button class="flex items-center w-full" onclick="toggleProfile()">
                    <x-nav-link class=" flex items-center p-2 text-base font-normal text-gray-900 w-full"
                        :active="request()->routeIs('profile.edit')">
                        <i class='bx bxs-user-circle'></i>
                        <span class="ml-3">
                            {{ Auth::user()->name }}
                        </span>
                        <svg class="ml-auto transition-all duration-300 ease-in-out" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" width="30px" height="30px" id="dropdown-profile">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </x-nav-link>
                </button>
                <div id="profile" class="hidden ml-3 transition-all duration-300 ease-in-out">
                    <ul>
                        <li class=" border-gray-600 ">
                            <x-nav-link :href="route('profile.edit')"
                                class="flex items-center p-2 text-base font-normal text-gray-900">
                                <span class="mt-3">{{ __('Profile') }}</span>
                            </x-nav-link>
                        </li>
                        <li class=" border-gray-600 ">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-nav-link :href="route('logout')"
                                    class="flex items-center p-2 text-base font-normal text-gray-900"
                                    onclick="event.preventDefault();
                                   this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-nav-link>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>

        <!-- Navigation Links -->
        <ul class="space-y-4 mt-5 p-0">
            @if (Auth::user()->role == 'admin')
                <li class=" border-gray-600 ">
                    <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')"
                        class="flex items-center p-2 text-base font-normal text-gray-900">
                        <i class='bx bxs-dashboard'></i>
                        <span class="ml-3">{{ __('Dashboard') }}</span>
                    </x-nav-link>
                </li>
                <li class=" border-gray-600 ">
                    <button class="flex items-center w-full" onclick="toggleDropdown()">
                        <x-nav-link class="flex items-center p-2 text-base font-normal text-gray-900 w-full"
                            :active="request()->routeIs('admin.users')">
                            <i class='bx bx-user'></i>
                            <span class="ml-3">
                                {{ __('Users') }}
                            </span>
                            <svg class="ml-auto transition-all duration-300 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                width="30px" height="30px" id="dropdown-icon">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </x-nav-link>
                    </button>
                    <div id="dropdown" class="hidden ml-3 transition-all duration-300 ease-in-out">
                        <ul>
                            <li class=" border-gray-600 ">
                                <x-nav-link :href="route('admin.users')"
                                    class="flex items-center p-2 text-base font-normal text-gray-900">
                                    <i class='bx bx-user'></i>
                                    <span class=" ml-3">{{ __('Semua User') }}</span>
                                </x-nav-link>
                            </li>
                            <li class=" border-gray-600 ">
                                <x-nav-link :href="route('admin.users', ['role' => 'mahasiswa'])"
                                    class="flex items-center p-2 text-base font-normal text-gray-900">
                                    <i class='bx bxs-graduation'></i>
                                    <span class="ml-3">{{ __('Mahasiswa') }}</span>
                                </x-nav-link>
                            </li>
                            <li class=" border-gray-600 ">
                                <x-nav-link :href="route('admin.users', ['role' => 'dosen'])"
                                    class="flex items-center p-2 text-base font-normal text-gray-900">
                                    <i class='bx bxs-user-detail'></i>
                                    <span class="ml-3">{{ __('Dosen') }}</span>
                                </x-nav-link>
                            </li>
                            <li class=" border-gray-600 ">
                                <x-nav-link :href="route('admin.users', ['role' => 'admin'])"
                                    class="flex items-center p-2 text-base font-normal text-gray-900">
                                    <i class='bx bxs-user-badge'></i>
                                    <span class="ml-3">{{ __('Admin') }}</span>
                                </x-nav-link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class=" border-gray-600 ">
                    <button class="flex items-center w-full" onclick="toggleSkripsi()">
                        <x-nav-link class="flex items-center p-2 text-base font-normal text-gray-900 w-full"
                            :active="request()->routeIs('admin.pengajuanSkripsi', 'admin.monitoringSkripsi')">
                            <i class='bx bxs-book-content'></i>
                            <span class="ml-3">
                                {{ __('Skripsi') }}
                            </span>
                            <svg class="ml-auto transition-all duration-300 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                width="30px" height="30px" id="dropdowm-skripsi">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </x-nav-link>
                    </button>
                    <div id="skripsi" class="hidden ml-3 transition-all duration-1000 ease-in-out">
                        <ul>
                            <li class=" border-gray-600 ">
                                <x-nav-link :href="route('admin.mahasiswa.documents')" :active="request()->routeIs('admin.mahasiswa.documents')"
                                    class="flex items-center p-2 text-base font-normal text-gray-900">
                                    <i class='bx bxs-book'></i>
                                    <span class="ml-3">{{ __('Kelengkapan Dokumen') }}</span>
                                </x-nav-link>
                            </li>
                            <li class=" border-gray-600 ">
                                <x-nav-link :href="route('admin.proposal')" :active="request()->routeIs('admin.proposal')"
                                    class="flex items-center p-2 text-base font-normal text-gray-900">
                                    <i class='bx bxs-book'></i>
                                    <span class="ml-3">{{ __('Proposal') }}</span>
                                </x-nav-link>
                            </li>
                            <li class=" border-gray-600 ">
                                <x-nav-link :href="route('admin.pengajuanSkripsi')" :active="request()->routeIs('admin.pengajuanSkripsi')"
                                    class="flex items-center p-2 text-base font-normal text-gray-900">
                                    <i class='bx bxs-book-add'></i>
                                    <span class="ml-3">{{ __('Data Pengajuan Skripsi') }}</span>
                                </x-nav-link>
                            </li>
                            <li class=" border-gray-600 ">
                                <x-nav-link :href="route('admin.monitoringSkripsi')" :active="request()->routeIs('admin.monitoringSkripsi')"
                                    class="flex items-center p-2 text-base font-normal text-gray-900">
                                    <i class='bx bxs-book'></i>
                                    <span class="ml-3">{{ __('Monitoring Skripsi') }}</span>
                                </x-nav-link>
                            </li>
                            <li class=" border-gray-600 ">
                                <x-nav-link :href="route('admin.schedules')" :active="request()->routeIs('admin.schedules')"
                                    class="flex items-center p-2 text-base font-normal text-gray-900">
                                    <i class='bx bxs-calendar'></i>
                                    <span class="ml-3">{{ __('Jadwal Sidang') }}</span>
                                </x-nav-link>
                            </li>
                        </ul>
                    </div>
                </li>
                <span class="ml-3">
                    <li class=" border-gray-600 ">
                        <button class="flex items-center w-full" onclick="toggleStudi()">
                            <x-nav-link class="flex items-center p-2 text-base font-normal text-gray-900 w-full"
                                :active="request()->routeIs('admin.prodi', 'admin.editPembimbing')">
                                <i class='bx bxs-book-open'></i>
                                <span class="ml-3">
                                    {{ __('Studi') }}
                                </span>
                </span>
                <svg class="ml-auto transition-all duration-300 ease-in-out" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20" fill="currentColor" width="30px" height="30px" id="dropdown-studi">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
                </x-nav-link>
                </button>
                <div id="studi" class="hidden ml-3 transition duration-300 ease-in-out">
                    <ul>
                        <li class=" border-gray-600 ">
                            <x-nav-link :href="route('admin.prodi')" :active="request()->routeIs('admin.prodi')"
                                class="flex items-center p-2 text-base font-normal text-gray-900">
                                <i class='bx bxs-school'></i>
                                <span class="ml-3">{{ __('Data Prodi') }}</span>
                            </x-nav-link>
                        </li>
                        <li class=" border-gray-600 ">
                            <x-nav-link :href="route('admin.dosen')" :active="request()->routeIs('admin.editPembimbing')"
                                class="flex items-center p-2 text-base font-normal text-gray-900">
                                <i class='bx bxs-edit-alt'></i>
                                <span class="ml-3">{{ __('Dosen Pembimbing') }}</span>
                            </x-nav-link>
                        </li>
                    </ul>
                </div>
                </li>
                <x-nav-link :href="route('chat.index')" :active="request()->routeIs('chat.index')"
                    class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class='bx bx-conversation'></i>
                    <span class="ml-3">{{ __('Chat') }}</span>
                </x-nav-link>
            </li>
            @endif
            @if (Auth::user()->role == 'dosen')
                <li>
                    <x-nav-link :href="route('dosen.dashboard')" :active="request()->routeIs('dosen.dashboard')"
                        class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class='bx bxs-dashboard'></i>
                        <span class="ml-3">{{ __('Dashboard') }}</span>
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('dosen.bimbingan')" :active="request()->routeIs('dosen.bimbingan')"
                        class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class='bx bxs-edit-alt'></i>
                        <span class="ml-3">{{ __('Mahasiswa Bimbingan') }}</span>
                    </x-nav-link>
                </li>

                <li class=" border-gray-600 ">
                    <button class="flex items-center w-full" onclick="toggleSidang()">
                        <x-nav-link class="flex items-center p-2 text-base font-normal text-gray-900 w-full"
                            :active="request()->routeIs(
                                'dosen.mahasiswa.documents',
                                'dosen.schedules.index',
                                'dosen.monitor',
                            )">
                            <i class='bx bxs-book-open'></i>
                            {{ __('Skripsi') }}
                            </span>
                            <svg class="ml-auto transition-all duration-300 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                width="30px" height="30px" id="dropdown-sidang">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </x-nav-link>
                    </button>
                    <div id="sidang" class="hidden ml-3 transition-all duration-300 ease-in-out">
                        <ul>
                            <li class=" border-gray-600 ">
                                <x-nav-link :href="route('dosen.mahasiswa.documents')" :active="request()->routeIs('dosen.mahasiswa.documents')"
                                    class="flex items-center p-2 text-base font-normal text-gray-900">
                                    <i class='bx bxs-book'></i>
                                    <span class="ml-3">{{ __('Kelengkapan Dokumen') }}</span>
                                </x-nav-link>
                            </li>
                            <li class=" border-gray-600 ">
                                <x-nav-link :href="route('dosen.schedules.index')" :active="request()->routeIs('dosen.schedules.index')"
                                    class="flex items-center p-2 text-base font-normal text-gray-900">
                                    <i class='bx bxs-book'></i>
                                    <span class="ml-3">{{ __('Jadwal Sidang') }}</span>
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link :href="route('dosen.monitor')" :active="request()->routeIs('dosen.monitor')"
                                    class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <i class='bx bxs-book'></i>
                                    <span class="ml-3">{{ __('Monitor') }}</span>
                                </x-nav-link>
                            </li>
                        </ul>
                    </div>
                <li>
                    <x-nav-link :href="route('chat.index')" :active="request()->routeIs('chat.index')"
                        class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class='bx bx-conversation'></i>
                        <span class="ml-3">{{ __('Chat') }}</span>
                    </x-nav-link>
                </li>
            @endif
            @if (Auth::user()->role == 'mahasiswa')
                <li>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="bx bxs-dashboard"></i>
                        <span class="ml-3">{{ __('Dashboard') }}</span>
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('dokumen')" :active="request()->routeIs('dokumen')"
                        class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class='bx bx-list-check'></i>
                        <span class="ml-3">{{ __('Lengkapi Dokumen') }}</span>
                    </x-nav-link>
                </li>
                <li>
                    <button class="flex items-center w-full" onclick="togglePengajuan()">
                        <x-nav-link class="flex items-center p-2 text-base font-normal text-gray-900 w-full"
                            :active="request()->routeIs('admin.pengajuanSkripsi', 'admin.monitoringSkripsi')">
                            <i class='bx bxs-book-content'></i>
                            <span class="ml-3">
                                {{ __('Pengajuan') }}
                            </span>
                            <svg class="ml-auto transition-all duration-300 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                width="30px" height="30px" id="dropdown-pengajuan">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </x-nav-link>
                    </button>
                    <div class="hidden ml-3 transition-all duration-300 ease-in-out" id="pengajuan">
                        <ul>
                            <li>
                                <x-nav-link :href="route('proposal.create')" :active="request()->routeIs('skripsi.create')"
                                    class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <i class='bx bxs-book'></i>
                                    <span class="ml-3">{{ __('Ajukan Proposal') }}</span>
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link :href="route('skripsi.create')" :active="request()->routeIs('skripsi.create')"
                                    class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <i class='bx bxs-book'></i>
                                    <span class="ml-3">{{ __('Ajukan Skripsi') }}</span>
                                </x-nav-link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <x-nav-link :href="route('chat.index')" :active="request()->routeIs('chat.index')"
                        class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class='bx bx-conversation'></i>
                        <span class="ml-3">{{ __('Chat') }}</span>
                    </x-nav-link>
                </li>
            @endif
        </ul>
        <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
        <div class="absolute bottom-0 left-0 w-full p-4 border-t border-gray-600">
            <p class="text-center text-sm text-black">&copy; copyright2024KD | 20110163</p>
        </div>
    </div>
</aside>
