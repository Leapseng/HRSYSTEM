<x-home-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payroll') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Salary</th>
                                <th class="px-4 py-2">Payroll Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payroll as $record)
                                <tr>
                                    <td class="border px-4 py-2">{{ $record->salary }} $</td>
                                    <td class="border px-4 py-2">{{ Carbon\Carbon::parse($record->payroll_date)->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="border px-4 py-2">No payroll data available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>
