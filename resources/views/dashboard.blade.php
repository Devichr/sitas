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

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
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
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 my-4">
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
                    <h2 class="text-gray-600">Judul Skripsi</h2>
                    @if ($skripsiJudul->count() > 0)
                        @foreach ($skripsiJudul as $s )

                        @endforeach
                        <p class="text-gray-800 text-2xl">{{ $s->judul }}</p>
                        @else
                        <p class="text-gray-800 text-2xl">Yahh Skripsimu Belum di acc nih</p>
                        @endif
                </div>
            </div>
        </div>
        <div class="bg-white shadow-[inset_11px_0px_0px_0px_#3B44F6] rounded-lg p-4">
            <div class="flex items-center min-h-32 justify-between">
                <div class="text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#3B44F6" width="80px"
                        height="80px">
                        <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M219.3 .5c3.1-.6 6.3-.6 9.4 0l200 40C439.9 42.7 448 52.6 448 64s-8.1 21.3-19.3 23.5L352 102.9l0 57.1c0 70.7-57.3 128-128 128s-128-57.3-128-128l0-57.1L48 93.3l0 65.1 15.7 78.4c.9 4.7-.3 9.6-3.3 13.3s-7.6 5.9-12.4 5.9l-32 0c-4.8 0-9.3-2.1-12.4-5.9s-4.3-8.6-3.3-13.3L16 158.4l0-71.8C6.5 83.3 0 74.3 0 64C0 52.6 8.1 42.7 19.3 40.5l200-40zM111.9 327.7c10.5-3.4 21.8 .4 29.4 8.5l71 75.5c6.3 6.7 17 6.7 23.3 0l71-75.5c7.6-8.1 18.9-11.9 29.4-8.5C401 348.6 448 409.4 448 481.3c0 17-13.8 30.7-30.7 30.7L30.7 512C13.8 512 0 498.2 0 481.3c0-71.9 47-132.7 111.9-153.6z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-gray-600">Dosen Pembimbingmu</h2>
                    @foreach ($dospem as $d)
                    <p class="text-gray-800 text-2xl">{{$d->name}}</p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bg-white shadow-[inset_11px_0px_0px_0px_#06D001] rounded-lg p-4">
            <div class="flex items-center min-h-32 justify-between">
                <div class="text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#06D001" width="80px" height="90px" viewBox="0 0 24 24"><path d="M21 20V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2zM9 18H7v-2h2v2zm0-4H7v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm2-5H5V7h14v2z"></path></svg>
                </div>
                <div>
                    <h2 class="text-gray-600">Tanggal Sidang</h2>
                    @if ($schedule->count() > 0)
                    @foreach ($schedule as $s )
                    <p class="text-gray-800 text-2xl">{{ $s->schedule_date }}</p>
                    @endforeach
                    @else
                    <p class="text-gray-800 text-2xl">Belum Ada Tanggal Sidang</p>
                    @endif
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
                <p class="text-lg font-semibold">Pengajuan Skripsi</p>
                    <div class="relative w-full h-72">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-800 tracking-wider">
                                        Judul</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-800 tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-800 tracking-wider">
                                        keterangan</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($skripsis as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $item->judul }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $item->status }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $item->keterangan }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 text-sm leading-5 text-center text-gray-500">
                                            <a href="{{ route('skripsi.edit', $item->id) }}"
                                               class="bg-indigo-600 text-white rounded-md p-2 hover:bg-indigo-900">Edit</a>
                                               <form action="{{ route('skripsi.destroy', $item->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')" class="ml-5 bg-red-600 text-white rounded-md p-2 hover:bg-red-900">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
            <div class="bg-white overflow-auto shadow-xl sm:rounded-lg p-6 col-span-2">
                <p class="text-lg font-semibold">Pengajuan Proposal</p>
                    <div class="relative w-full h-72">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-800 tracking-wider">
                                        Judul</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-800 tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($proposals as $items)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $items->judul }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $items->status }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
