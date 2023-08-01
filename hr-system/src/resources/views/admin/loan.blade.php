<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payroll') }}
        </h2>
        <div class="flex justify-end">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="alert alert-success" style="background-color: green; color: white;">
                            {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(function(){
                                document.querySelector('.alert-success').style.display = 'none';
                            }, 3000);
                        </script>
                    @endif

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Loan Amount</th>
                                <th class="px-4 py-2">Reason</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td class="border px-4 py-2">{{ $loan->user->name }}</td>
                                    <td class="border px-4 py-2">{{ $loan->loan_amount }}</td>
                                    <td class="border px-4 py-2">{{ $loan->reason }}</td>
                                    <td class="border px-4 py-2">
                                        <form action="{{ route('loan.update', ['id' => $loan->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="relative inline-flex">
                                                <select
                                                    name="status"
                                                    class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                    onchange="this.form.submit()"
                                                >
                                                    <option value="Pending" @if($loan->status === 'Pending') selected @endif>Pending</option>
                                                    <option value="Approve" @if($loan->status === 'Approve') selected @endif>Approve</option>
                                                    <option value="Disapprove" @if($loan->status === 'Disapprove') selected @endif>Disapprove</option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                                                            clip-rule="evenodd"
                                                        ></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="border px-4 py-2">
                                        @if ($loan->file)
                                            @php
                                            $extension = pathinfo($loan->file, PATHINFO_EXTENSION);
                                            @endphp
                                            <a href="{{ route('loan.download', ['file' => $loan->file]) }}" target="_blank">View File ({{ strtoupper($extension) }})</a>
                                        @else
                                            No file attached.
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
