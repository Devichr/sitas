<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Pengguna') }}
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

        <form action="{{ route('admin.updatePembimbing', $mahasiswa->id) }}" method="POST">
            @csrf
            <div class="mt-4">
                <x-input-label for="role" :value="__('Nama Mahasiswa')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $mahasiswa->name)" disabled/>
            </div>
            <div class="mt-4">
                <x-input-label for="role" :value="__('Dosen Pembimbing')" />
                <select id="dosen_pembimbing" name="dosen_pembimbing" class="block mt-1 w-full">
                    <option value="">Pilih Dosen</option>
                    @foreach($dosens as $dosen)
                    <option value="{{ $dosen->id }}" {{ $mahasiswa->dosen_pembimbing == $dosen->id ? 'selected' : '' }}>{{ $dosen->name }}</option>
                    @endforeach
                </select>
            </div>
            </div>
            <div class="flex items-center mt-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
            </div>
        </form>
    </div>
</x-app-layout>
