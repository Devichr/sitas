<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Prodi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2 text-right">
                <a href="{{ route('admin.prodi.create') }}"
                class="bg-indigo-600 text-white rounded-sm p-3 hover:bg-indigo-900 shadow-md">Add User <b class="font-bold text-lg">+</b></a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-800 tracking-wider">Program Studi</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-800 tracking-wider">Nama Kaprodi</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($prodi as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $item->name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $item->kaprodi->name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 text-sm leading-5 text-gray-500 text-center">
                                    <a href="{{ route('admin.prodi.edit', $item->id) }}" class="ml-5 bg-indigo-600 text-white rounded-md p-2 hover:bg-indigo-900">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
