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
                            Judul</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-800 tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($skripsi as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $item->judul }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $item->status }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 text-sm leading-5 text-center text-gray-500">
                                <form action="{{ route('admin.skripsi.approve', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white p-2 rounded">Setujui</button>
                                </form>
                                <form action="{{ route('admin.skripsi.reject', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white p-2 rounded">Tolak</button>
                                </form>
                                <a href="{{ route('admin.skripsi.download', $item->id) }}" class="bg-blue-500 text-white p-2 rounded">Download</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </div>

</x-app-layout>
