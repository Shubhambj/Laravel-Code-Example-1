<div class="card">
    <div class="card-header">{{ __('lang.employees') }}</div>

    <div class="card-body">
        
        <a href="javascript:void(0);" data-url="{{ route('employee.create') }}" onclick="loadModel(this)" class="btn btn-warning float-right load_model_box" style="margin-bottom: 20px;">
            {{ __('lang.add_employee') }}
        </a>

        <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('lang.first_name') }}</th>
                        <th scope="col">{{ __('lang.last_name') }}</th>
                        <th scope="col">{{ __('lang.email') }}</th>
                        <th scope="col">{{ __('lang.phone') }}</th>
                        <th scope="col">{{ __('lang.company') }}</th>
                        <th scope="col">{{ __('lang.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <th scope="row">{{ $employee->id }}</th>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->companyName }}</td>
                        <td>
                            <a href="javascript:void(0);" data-url="{{ route('employee.show', ['id' => $employee->id]) }}" onclick="loadModel(this);" class="btn btn-warning">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </a>

                            <a href="javascript:void(0);" data-url="{{ route('employee.edit', ['id' => $employee->id]) }}" onclick="loadModel(this);" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="javascript:void(0);" data-url="{{ route('employee.destroy', ['id' => $employee->id]) }}" onclick="deleteRecord(this, loadAllRecords);" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
        <div style="float: right;">
            {!! $employees->links() !!}
        </div>
        
        @include('common.model_box', ['modelTitle' => __('lang.employee_details') ])

    </div>
</div>
<script type="text/javascript">
    function loadAllRecords() {
        $.get("{{ route('employee.index') }}", function(data){
            $('#module_content_container').html(data);
        });
    }
    
    $(() => {
        $('.pagination a').on('click', (e) => {
            e.preventDefault();

            let _url = $(e.target).attr('href');
            $.get(_url, (data) => {
                $('#module_content_container').html(data);
            });
        });
    });
</script>