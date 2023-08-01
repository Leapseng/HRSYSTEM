<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payroll') }}
        </h2>
        <div class="flex justify-end">

            <div class="flex justify-end">

                <x-success-button x-data="" x-on:click.prevent="window.location.href = '{{ route('payroll.create') }}'">
                    {{ __('New Payroll') }}
                </x-success-button>
                                    
            </div>
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
                                <th class="px-4 py-2">Salary</th>
                                <th class="px-4 py-2">Payroll Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payroll as $payroll)
                                <tr>
                                    <td class="border px-4 py-2" style="cursor: pointer;" 
                                        >
                                        {{ $payroll->user->name }}
                                    </td>
                                    
                                       
                                            <td class="border px-4 py-2">{{ $payroll->salary }} $</td>
                                            <td class="border px-4 py-2">{{ Carbon\Carbon::parse($payroll->payroll_date)->format('d/m/Y') }}</td>
                                      
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>



{{-- <x-app-layout>
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
                                <th class="px-4 py-2">Salary</th>
                                <th class="px-4 py-2">Payroll Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payroll as $payroll)
                            <tr>
                                <td class="border px-4 py-2" style="cursor: pointer;" 
                                    onclick="window.location.href = '{{ route('payroll.create', ['user' => $payroll->user->id]) }}'">
                                    {{ $payroll->user->name }}
                                </td>
                                <td class="border px-4 py-2">{{ $payroll->salary }} $</td>
                                <td class="border px-4 py-2">{{ Carbon\Carbon::parse($payroll->payroll_date)->format('d/m/Y') }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
