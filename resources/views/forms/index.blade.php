<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lengkapi Dokumen') }}
        </h2>
    </x-slot>

    <div class="py-6 px-3">
        <div class="container mx-auto mt-5">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

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

            <h2 class="text-xl font-bold mt-8 mb-4">Upload Form</h2>
            <form action="{{ route('dokumen.upload') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
                @csrf
                <div class="mb-4">
                    <label for="form_name" class="block text-gray-700 text-sm font-bold mb-2">Form Name</label>
                    <select name="form_name" id="form_name" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="form_prasidang">Form Prasidang</option>
                        <option value="form_nilai_prasidang">Form Nilai PraSidang</option>
                        <option value="form_sidang">Form Sidang</option>
                        <option value="form_nilai_sidang">Form Nilai Sidang</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                        <span>Choose File</span>
                        <input type="file" name="form_file" id="form_file" class="hidden">
                    </label>
                    <span id="file-chosen" class="ml-2">No file chosen</span>
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Upload
                </button>
            </form>
        </div>

        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script>
            document.getElementById('form_file').addEventListener('change', function() {
            var fileName = this.files[0].name;
            document.getElementById('file-chosen').textContent = fileName;
        });
        </script>

    </div>
</x-app-layout>
