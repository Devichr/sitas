<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Kelengkapan dokumen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b-2 border-gray-300 text-center leading-4 text-gray-800 tracking-wider">
                                Mahasiswa</th>
                            <th
                                class="px-6 py-3 border-b-2 border-gray-300 text-center leading-4 text-gray-800 tracking-wider">
                                Form Prasidang</th>
                            <th
                                class="px-6 py-3 border-b-2 border-gray-300 text-center leading-4 text-gray-800 tracking-wider">
                                Form Nilai Prasidang</th>
                            <th
                                class="px-6 py-3 border-b-2 border-gray-300 text-center leading-4 text-gray-800 tracking-wider">
                                Form Sidang</th>
                            <th
                                class="px-6 py-3 border-b-2 border-gray-300 text-center leading-4 text-gray-800 tracking-wider">
                                Form Nilai Sidang</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($students as $student)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $student->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    @if ($student->formStatus['form_prasidang'])
                                         <p class="text-center">
                                        <i class="fas fa-check-circle text-green-600"></i>
                                    </p>
                                    @else
                                         <p class="text-center">
        <i class="fas fa-times-circle text-red-600"></i>
                                    </p>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    @if ($student->formStatus['form_nilai_prasidang'])
                                    <p class="text-center">
                                        <i class="fas fa-check-circle text-green-600"></i>
                                    </p>
                                    @else
                                         <p class="text-center">
        <i class="fas fa-times-circle text-red-600"></i>
                                    </p>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    @if ($student->formStatus['form_sidang'])
                                         <p class="text-center">
                                        <i class="fas fa-check-circle text-green-600"></i>
                                    </p>
                                    @else
                                         <p class="text-center">
        <i class="fas fa-times-circle text-red-600"></i>
                                    </p>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    @if ($student->formStatus['form_nilai_sidang'])
                                         <p class="text-center">
                                        <i class="fas fa-check-circle text-green-600"></i>
                                    </p>
                                    @else
                                         <p class="text-center">
        <i class="fas fa-times-circle text-red-600"></i>
                                    </p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 text-sm leading-5 text-gray-500 text-center">
                                    <a href="{{ route('admin.mahasiswa.view', $student->id) }}" class="bg-blue-500 text-white p-2 rounded">Detail</a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
