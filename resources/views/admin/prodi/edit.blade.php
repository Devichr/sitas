<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Prodi') }}
        </h2>
    </x-slot>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form action="{{ route('admin.prodi.update', $prodi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  value="{{ old('name', $prodi->name) }}" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mt-4">
            <x-input-label for="kaprodi" :value="__('Kaprodi')" />
            <select name="kaprodi_id" class="block mt-1 w-full">
                @foreach($kaprodis as $id => $name)
                <option value="{{ $id }}" {{ $prodi->kaprodi_id == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="flex gap-8 items-center my-4">

        <x-primary-button>{{ __('Edit Prodi') }}</x-primary-button>
    </form>
</x-app-layout>
