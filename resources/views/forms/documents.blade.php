<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Bimbingan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto mt-5">
                <h1 class="text-2xl font-bold mb-4">Document Status for {{ $student->name }}</h1>

                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach(['form_prasidang', 'form_nilai_prasidang', 'form_sidang', 'form_nilai_sidang'] as $form)
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h5 class="text-lg font-semibold mb-2">{{ ucwords(str_replace('_', ' ', $form)) }}</h5>
                            @if($formStatus[$form])
                                <p class="text-green-600 mb-2">Uploaded <i class="fas fa-check-circle"></i></p>
                                <a href="{{ Storage::url($formStatus[$form]->file_path) }}" class="text-blue-500 hover:underline" target="_blank">View Form</a>
                            @else
                                <p class="text-red-600 mb-2">Not Uploaded <i class="fas fa-times-circle"></i></p>
                            @endif
                        </div>
                    @endforeach
                </div>

            <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </div>

</x-app-layout>
