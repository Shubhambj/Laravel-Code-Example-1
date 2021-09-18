<div class="card">
    <div class="card-header">{{ __('lang.employees') }}</div>

    <div class="card-body">
        
        <a href="javascript:void(0);" data-url="{{ route('employee.create') }}" class="btn btn-warning float-right load_model_box" style="margin-bottom: 20px;">
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
                            <a href="javascript:void(0);" data-url="{{ route('employee.show', ['id' => $employee->id]) }}" class="btn btn-warning load_model_box">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </a>

                            <a href="javascript:void(0);" data-url="{{ route('employee.edit', ['id' => $employee->id]) }}" class="btn btn-primary load_model_box">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="javascript:void(0);" onclick="deleteRecord(this);" data-url="{{ route('employee.destroy', ['id' => $employee->id]) }}" class="btn btn-danger">
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
    $(() => {
        
        $('.pagination a').on('click', (e) => {
            e.preventDefault();

            let _url = $(e.target).attr('href');

            $.get(_url, (data) => {
                $('#module_content_container').html(data);
            });
        });

        $('.load_model_box').on('click', (e) => {
            e.preventDefault();
            
            let _url = $(e.target).data('url');
            
            $.get(_url, (data) => {
                $('.modal-body').html(data);
                $('#empModal').modal('show'); 
            });
        });
    });
    
    function deleteRecord(e) {
        let _url = $(e).attr('data-url');
            
        $.ajax({
            type: "POST",
            method: "DELETE",
            url: _url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $.get("{{ route('employee.index') }}", function(data, status){
                    $('#module_content_container').html(data);
                });
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

</script>