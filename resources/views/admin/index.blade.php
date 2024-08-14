<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="py-6 px-3">
        <div class="bg-green-400 border-2 border-green-800 rounded-lg flex" id="notif">
            <div class=" flex justify-center flex-col w-full">
                <p class="text-lg justify-center text-center py-3">Hallo, <span class="font-bold">{{Auth::user()->name}}</span> Selamat datang di SITAS STMIK Mardira Indonesia</p>
                <p class="text-center">&copy; copyright2024KD | 20110163</p>
            </div>
            <div class="flex items-center w-ful">
                <button onclick="closeNotif()">
                    <i class='bx bx-window-close bx-sm'></i>
                </button>
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 my-4">
            <div class="bg-white shadow-[inset_11px_0px_0px_0px_#FF204E] rounded-lg p-4">
                <div class="flex items-center min-h-32 justify-between">
                    <div class="text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#FF204E" width="80px"
                            height="80px">
                            <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M219.3 .5c3.1-.6 6.3-.6 9.4 0l200 40C439.9 42.7 448 52.6 448 64s-8.1 21.3-19.3 23.5L352 102.9l0 57.1c0 70.7-57.3 128-128 128s-128-57.3-128-128l0-57.1L48 93.3l0 65.1 15.7 78.4c.9 4.7-.3 9.6-3.3 13.3s-7.6 5.9-12.4 5.9l-32 0c-4.8 0-9.3-2.1-12.4-5.9s-4.3-8.6-3.3-13.3L16 158.4l0-71.8C6.5 83.3 0 74.3 0 64C0 52.6 8.1 42.7 19.3 40.5l200-40zM111.9 327.7c10.5-3.4 21.8 .4 29.4 8.5l71 75.5c6.3 6.7 17 6.7 23.3 0l71-75.5c7.6-8.1 18.9-11.9 29.4-8.5C401 348.6 448 409.4 448 481.3c0 17-13.8 30.7-30.7 30.7L30.7 512C13.8 512 0 498.2 0 481.3c0-71.9 47-132.7 111.9-153.6z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-gray-600">Jumlah Mahasiswa</h2>
                        <p class="text-gray-800 text-2xl">{{ $mahasiswaCount }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-[inset_11px_0px_0px_0px_#FFDB00] rounded-lg p-4">
                <div class="flex items-center justify-between min-h-32">
                    <div class="text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="#FFDB00" width="80px"
                            height="80px"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M192 96a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-8 384l0-128 16 0 0 128c0 17.7 14.3 32 32 32s32-14.3 32-32l0-288 56 0 64 0 16 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-16 0 0-64 192 0 0 192-192 0 0-32-64 0 0 48c0 26.5 21.5 48 48 48l224 0c26.5 0 48-21.5 48-48l0-224c0-26.5-21.5-48-48-48L368 0c-26.5 0-48 21.5-48 48l0 80-76.9 0-65.9 0c-33.7 0-64.9 17.7-82.3 46.6l-58.3 97c-9.1 15.1-4.2 34.8 10.9 43.9s34.8 4.2 43.9-10.9L120 256.9 120 480c0 17.7 14.3 32 32 32s32-14.3 32-32z" />
                        </svg>
                    </div>
                    <div class="">
                        <h2 class="text-gray-600">Jumlah Dosen</h2>
                        <p class="text-gray-800 text-2xl">{{ $dosenCount }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-[inset_11px_0px_0px_0px_#06D001]">
                <div class="flex items-center justify-between min-h-32">
                    <div class="text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#06D001" width="80px"
                            height="80px">
                            <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M160 96a96 96 0 1 1 192 0A96 96 0 1 1 160 96zm80 152l0 264-48.4-24.2c-20.9-10.4-43.5-17-66.8-19.3l-96-9.6C12.5 457.2 0 443.5 0 427L0 224c0-17.7 14.3-32 32-32l30.3 0c63.6 0 125.6 19.6 177.7 56zm32 264l0-264c52.1-36.4 114.1-56 177.7-56l30.3 0c17.7 0 32 14.3 32 32l0 203c0 16.4-12.5 30.2-28.8 31.8l-96 9.6c-23.2 2.3-45.9 8.9-66.8 19.3L272 512z" />
                        </svg>
                    </div>
                    <div class="">
                        <h2 class="text-gray-600">Jumlah Prodi</h2>
                        <p class="text-gray-800 text-2xl">{{ $prodiCount }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-[inset_11px_0px_0px_0px_#3B44F6] rounded-lg p-4">
                <div class="flex items-center justify-between min-h-32">
                    <div class="text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#3B44F6" width="80px"
                            height="80px"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l288 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64c17.7 0 32-14.3 32-32l0-320c0-17.7-14.3-32-32-32L384 0 96 0zm0 384l256 0 0 64L96 448c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16zm16 48l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                        </svg>
                    </div>
                    <div class="">
                        <h2 class="text-gray-600">Jumlah Skripsi</h2>
                        <p class="text-gray-800 text-2xl">{{ $skripsiCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white overflow-auto shadow-xl sm:rounded-lg p-6 col-span-2 row-span-2 bg-[url('../assets/logo.png')] bg-[length:300px_300px] bg-no-repeat bg-center">
                <div class="bg-white bg-opacity-50">
                    <h1 class="text-xl text-center font-bold mb-2"> Sejarah </br> STMIK Mardira Indonesia </h1>
                    <p class="font-semi-bold">Bertitik tolak dari keinginan untuk membantu  pemerintah di dalam merealisasikan tujuan pendidikan, khususnya dibidang pendidikan komputer, maka pada tanggal 19 September 1983 Yayasan Widyaloka Jakarta mengembangkan lembaga pendidikan luar sekolah dengan nama Pusat Pendidikan Komputer Widyaloka yang beralamat di jalan Gajah Mada No.3-5 Jakarta Pusat.
                        Guna memperluas  jaringan, maka dibukalah cabang Pusat Pendidikan Komputer Widyaloka Bandung yang merupakan cabang ke-enam dan secara resmi berdiri pada 4 Januari 1988, dengan lokasi di jalan ABC No.64-66 Bandung dan Jalan Soekarno-Hatta No.236 Bandung. PPK Widyaloka Bandung mulai diselenggarakan berdasarkan ijin Kanwil DEPDIKBUD Propinsi Jawa Barat pada tanggal 13 Februari 1988 Nomor 008/I.02.10/C/L.90 dan secara institusional PPK widyaloka yang berfungsi sebagai lembaga swadaya Masyarakat di bidang formal maupun non formal. </p>
                    </div>
            </div>
            <div class="bg-white overflow-auto shadow-xl sm:rounded-lg p-6 col-span-2">
                <p class="text-lg font-semibold">Diagram Status Pengajuan Proposal</p>
                <div class=" flex justify-between">
                    <div class="chart-container">
                        <canvas id="proposalChart"></canvas>
                    </div>
                    <div class="">
                        <h3 class="font-semibold text-lg">Persentase:</h3>
                        <p>Pengajuan: {{ number_format($persentase['pengajuan'], 2) }}%</p>
                        <p>ACC: {{ number_format($persentase['acc'], 2) }}%</p>
                        <p>Ditolak: {{ number_format($persentase['ditolak'], 2) }}%</p>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-auto shadow-xl sm:rounded-lg p-6 col-span-2">
                <p class="text-lg font-semibold">Diagram Tanggal Pengajuan Proposal</p>
                    <div class="relative w-full h-72">
                        <canvas id="dateStatusChart"></canvas>
                    </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
<script>
    const ctx = document.getElementById('proposalChart').getContext('2d');
    const ctx2 = document.getElementById('dateStatusChart').getContext('2d');
    const proposalData = @json($data);
    const pengajuanData = @json($dataPengajuan);
    const accData = @json($dataAcc);
    const ditolakData = @json($dataDitolak);

    const formattedPengajuanData = pengajuanData.map(item => ({ x: item.date, y: item.count }));
    const formattedAccData = accData.map(item => ({ x: item.date, y: item.count }));
    const formattedDitolakData = ditolakData.map(item => ({ x: item.date, y: item.count }));

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pengajuan', 'ACC', 'Ditolak'],
            datasets: [{
                data: [proposalData.pengajuan, proposalData.acc, proposalData.ditolak],
                backgroundColor: ['rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                borderColor: ['rgba(54, 162, 235, 1.2)', 'rgba(75, 192, 192, 1.2)', 'rgba(255, 99, 132, 1.2)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        }
    });

    new Chart(ctx2, {
        type: 'bar',
        data: {
            datasets: [
                {
                    label: 'Pengajuan',
                    data: formattedPengajuanData,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'blue',
                    borderWidth: 1
                },
                {
                    label: 'ACC',
                    data: formattedAccData,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'green',
                    borderWidth: 1
                },
                {
                    label: 'Ditolak',
                    data: formattedDitolakData,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'red',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'day'
                    },
                    title: {
                        display: false,
                        text: 'Date'
                    }
                },
                y: {
                    title: {
                        display: false,
                        text: 'Count'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
</script>

    </div>
</x-app-layout>
