<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Bimbingan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-800 tracking-wider">
                                Nama Mahasiswa</th>
                            <th
                                class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-800 tracking-wider">
                                Dosen Pembimbing</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($mahasiswa as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $item->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $item->dosen ? $item->dosen->name : 'Belum ditentukan' }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 text-sm leading-5 text-center text-gray-500">
                                    <a href="{{ route('admin.editPembimbing', $item->id) }}"
                                       class="bg-indigo-600 text-white rounded-md p-2 hover:bg-indigo-900" >Edit</a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
