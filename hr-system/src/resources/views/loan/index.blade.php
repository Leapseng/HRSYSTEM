<x-home-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Loan') }}
        </h2>
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
        <div class="flex justify-end">
            <x-success-button x-data="" x-on:click.prevent="window.location.href = '{{ route('loan.create') }}'">
                {{ __('Loan Request') }}
            </x-success-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Date</th>
                                <th class="px-4 py-2">Loan Amount</th>
                                <th class="px-4 py-2">Reason</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($loans as $loan)
                                <tr>
                                    <td class="border px-4 py-2">{{ $loan->created_at->format('d/m/Y') }}</td>
                                    <td class="border px-4 py-2">{{ $loan->loan_amount }} $</td>
                                    <td class="border px-4 py-2">{{ $loan->reason }}</td>
                                    <td class="border px-4 py-2 @if ($loan->status === 'Pending') text-orange-500 @elseif ($loan->status === 'Approve') text-green-800 @else text-red-600 @endif">
                                        {{ $loan->status }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="border px-4 py-2 text-center">You don't have loan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>
