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

        <form action="{{ route('dosen.schedules.store') }}" method="POST" class="mb-6">
            @csrf
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">Select Student</label>
                <select id="user_id" name="user_id" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="schedule_date" class="block text-sm font-medium text-gray-700">Schedule Date & Time</label>
                <input type="datetime-local" id="schedule_date" name="schedule_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('schedule_date')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

             <div class="mb-4">
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                @error('notes')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Schedule</button>
        </form>

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
