<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee') }}
        </h2>

        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
        <div class="flex justify-end">
            <x-success-button x-data="" x-on:click.prevent="window.location.href = '{{ route('employee.create') }}'">
                {{ __('New Employee') }}
            </x-success-button>
        </div>
        
    </x-slot>    
        
        

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="content-wrap bg-barong pt-0">
                        <div class="home-standings title-ornaments mb-lg-5">

                <div class="container">
            
                            <h1 class="text-center d-flex flex-row justify-content-center align-items-center" style="letter-spacing: 2px";>
                        EMPLOYEE
            
                                </h1>
                               <h1 style="color: white">OK</h1>
                    
                    <div class="tabs tabs-bb clearfix ui-tabs ui-corner-all ui-widget ui-widget-content" data-active="1">
                        
            
                        
                                                
                                <div class="tab-content clearfix" id="standing-regular-season">
                                    
                                                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table class="table table-sm table-standings dataTable no-footer" id="DataTables_Table_0" role="grid">
                                                                    @if ($employees->isEmpty())
                    <p>{{ __('No Employee found.') }}</p>
                @else
                                            <thead>
                                                <tr role="row">
                                                    <th class="team-header sorting_disabled" rowspan="1" colspan="1" style="width: 380.275px;"> Name </th>
                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 170.85px;"> Department </th>
                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 184.288px;"> Job Title </th>
                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 150.988px;"> Email </th>
                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 164.425px;">  </th>
                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 176.175px;"> </th>
                                                </tr>
                                            </thead>
            
                                            <tbody>                                                            
                                                
                                                @foreach ($employees as $employee)
                                                    <tr class="odd">
                                                        <td class="team-info">
                                                            <div class="d-flex flex-row justify-content-start align-items-center">
                                                                <div class="team-rank ms-lg-2 me-lg-2 my-lg-2">
                                                                    {{ $employee->id }}
                                                                </div>
                                                                <div class="team-name">
                                                                    <span class="d-none d-lg-block">
                                                                        <a href="{{ route('employee.show', ['employee' => $employee->id]) }}">{{ $employee->name }}</a>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                                                    
                                                    <td>
                                                        <div class="my-lg-2">
                                                            {{ \App\Models\admin\Department::getDepartmentTitle($employee->department) }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="my-lg-2">
                                                            {{ \App\Models\admin\Job::getJobTitle($employee->job) }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="my-lg-2">
                                                            {{ $employee->email }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="mx-lg-5">
                                                            <a href="{{ route('employee.edit', ['employee' => $employee->id]) }}" class="btn btn-primary">Edit</a>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="mx-lg-1">
                                                            <form id="form{{ $employee->id }}" method="POST" action="{{ route('employee.destroy', ['employee' => $employee->id]) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="javascript:void" onClick="onDelete('form{{ $employee->id }}')" class="btn btn-danger">Delete</a>
                                                                <script type="text/javascript">
                                                                    function onDelete(id) {
                                                                        if (confirm('Are you sure you want to delete this employee?')) {
                                                                            document.getElementById(id).submit();
                                                                        }
                                                                    }
                                                                </script>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    
                                                    
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        @endif
                                    </div></div><div class="row"><div class="col-sm-12 col-md-5"></div><div class="col-sm-12 col-md-7"></div></div></div>
                                        
                                        
                                                            
                                </div>
                                        
            
                </div>
            </div>
            
            
                       

    

</x-app-layout>
