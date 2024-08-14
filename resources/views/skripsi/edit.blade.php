<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambahkan Judul SKripsimu') }}
        </h2>
    </x-slot>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
    <form action="{{ route('skripsi.update', $skripsi) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mt-4">
            <x-input-label for="judul" :value="__('Judul')"/>
            <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" :value="old('judul', $skripsi->judul)" required autofocus autocomplete="judul" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="my-2">
            <x-input-label for="file" :value="__('File')"/>
            <input  type="file" name="file" accept="application/pdf" required>
        </div>
        <x-primary-button>{{ __('Update') }}</x-primary-button>
    </form>
        </div>
    </div>
</x-app-layout>
