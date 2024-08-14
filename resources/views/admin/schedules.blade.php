<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jadwalkan Sidang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="bg-green-500 text-white p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-xl font-bold mb-4">Sidang Terjadwal</h2>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Student Name</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Date & Time</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $schedule->user->name }}</td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $schedule->schedule_date }}</td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $schedule->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</x-app-layout>
