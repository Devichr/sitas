<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SITAS') }}</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3d2f999b29.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @media (min-width: 768px) {
            .main.active {
                margin-left: 256px;
                width: 100%;
            }
        }

        ::-webkit-scrollbar {
            display: none
        }

        .sidebar-menu {
            transition: transform 0.3s ease, background-color 0.3s ease;
            /* Menambah animasi transisi */
            background-color: #6482ad;
            /* Ubah warna latar belakang */
            color: #ecf0f1;
            /* Ubah warna teks */
        }

        .sidebar-overlay {
            transition: opacity 0.3s ease;
        }

        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }

        .dropdown-notifications {
            width: 250px;
            max-height: 300px;
            overflow-y: auto;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .dropdown-notifications.active {
            display: block;
        }
    </style>

</head>

<body class="font-sans antialiased">
    <div x-data="{ open: false }" class="flex flex-col sm:flex-row">
        <!-- Sidebar -->
        <div class="fixed">
            @include('layouts.navigation')
        </div>

        <!-- Main content -->
        <main class="w-screen bg-[#7FA1C3] min-h-screen transition-all main">
            <div class="flex-1 flex flex-col">
                <!-- Header with toggle button -->
                <header class="bg-white shadow w-full">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                        <button type="button" class="text-lg text-gray-900 font-semibold sidebar-toggle">
                            <i class="ri-menu-line"></i>
                        </button>
                        @if (isset($header))
                            {{ $header }}
                        @endif
                    </div>
                </header>
                <!-- Page Content -->
                {{ $slot }}
        </main>
    </div>
    </div>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById('dropdown');
            const icon = document.getElementById('dropdown-icon');
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('max-h-0');
            dropdown.classList.toggle('max-h-full');
            icon.classList.toggle('rotate-180');
        }

        function toggleProfile() {
            var dropdown = document.getElementById('profile');
            const icon = document.getElementById('dropdown-profile');
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('max-h-0');
            dropdown.classList.toggle('max-h-full');
            icon.classList.toggle('rotate-180');
        }

        function toggleSkripsi() {
            var dropdown = document.getElementById('skripsi');
            const icon = document.getElementById('dropdowm-skripsi');
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('max-h-0');
            dropdown.classList.toggle('max-h-full');
            icon.classList.toggle('rotate-180');
        }

        function toggleStudi() {
            var dropdown = document.getElementById('studi');
            const icon = document.getElementById('dropdown-studi');
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('max-h-0');
            dropdown.classList.toggle('max-h-full');
            icon.classList.toggle('rotate-180');
        }

        function togglePengajuan() {
            var dropdown = document.getElementById('pengajuan');
            const icon = document.getElementById('dropdown-pengajuan');
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('max-h-0');
            dropdown.classList.toggle('max-h-full');
            icon.classList.toggle('rotate-180');
        }

        function toggleSidang() {
            var dropdown = document.getElementById('sidang');
            const icon = document.getElementById('dropdown-sidang');
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('max-h-0');
            dropdown.classList.toggle('max-h-full');
            icon.classList.toggle('rotate-180');
        }

        function closeNotif() {
            var profile = document.getElementById('notif');
            profile.classList.add('hidden');
        }

        // start: Sidebar
        const sidebarToggle = document.querySelector('.sidebar-toggle')
        const sidebarOverlay = document.querySelector('.sidebar-overlay')
        const sidebarMenu = document.querySelector('.sidebar-menu')
        const main = document.querySelector('.main')
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault()
            main.classList.toggle('active')
            sidebarOverlay.classList.toggle('hidden')
            sidebarMenu.classList.toggle('-translate-x-full')
        })
        sidebarOverlay.addEventListener('click', function(e) {
            e.preventDefault()
            main.classList.add('active')
            sidebarOverlay.classList.add('hidden')
            sidebarMenu.classList.add('-translate-x-full')
        })
        document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(item) {
            item.addEventListener('click', function(e) {
                e.preventDefault()
                const parent = item.closest('.group')
                if (parent.classList.contains('selected')) {
                    parent.classList.remove('selected')
                } else {
                    document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(i) {
                        i.closest('.group').classList.remove('selected')
                    })
                    parent.classList.add('selected')
                }
            })
        })
        // end: Sidebar



        // start: Popper
        const popperInstance = {}
        document.querySelectorAll('.dropdown').forEach(function(item, index) {
            const popperId = 'popper-' + index
            const toggle = item.querySelector('.dropdown-toggle')
            const menu = item.querySelector('.dropdown-menu')
            menu.dataset.popperId = popperId
            popperInstance[popperId] = Popper.createPopper(toggle, menu, {
                modifiers: [{
                        name: 'offset',
                        options: {
                            offset: [0, 8],
                        },
                    },
                    {
                        name: 'preventOverflow',
                        options: {
                            padding: 24,
                        },
                    },
                ],
                placement: 'bottom-end'
            });
        })
        document.addEventListener('click', function(e) {
            const toggle = e.target.closest('.dropdown-toggle')
            const menu = e.target.closest('.dropdown-menu')
            if (toggle) {
                const menuEl = toggle.closest('.dropdown').querySelector('.dropdown-menu')
                const popperId = menuEl.dataset.popperId
                if (menuEl.classList.contains('hidden')) {
                    hideDropdown()
                    menuEl.classList.remove('hidden')
                    showPopper(popperId)
                } else {
                    menuEl.classList.add('hidden')
                    hidePopper(popperId)
                }
            } else if (!menu) {
                hideDropdown()
            }
        })

        function hideDropdown() {
            document.querySelectorAll('.dropdown-menu').forEach(function(item) {
                item.classList.add('hidden')
            })
        }

        function showPopper(popperId) {
            popperInstance[popperId].setOptions(function(options) {
                return {
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        {
                            name: 'eventListeners',
                            enabled: true
                        },
                    ],
                }
            });
            popperInstance[popperId].update();
        }

        function hidePopper(popperId) {
            popperInstance[popperId].setOptions(function(options) {
                return {
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        {
                            name: 'eventListeners',
                            enabled: false
                        },
                    ],
                }
            });
        }
        // end: Popper



        // start: Tab
        document.querySelectorAll('[data-tab]').forEach(function(item) {
            item.addEventListener('click', function(e) {
                e.preventDefault()
                const tab = item.dataset.tab
                const page = item.dataset.tabPage
                const target = document.querySelector('[data-tab-for="' + tab + '"][data-page="' + page +
                    '"]')
                document.querySelectorAll('[data-tab="' + tab + '"]').forEach(function(i) {
                    i.classList.remove('active')
                })
                document.querySelectorAll('[data-tab-for="' + tab + '"]').forEach(function(i) {
                    i.classList.add('hidden')
                })
                item.classList.add('active')
                target.classList.remove('hidden')
            })
        })
        // end: Tab
    </script>
</body>


</html>
