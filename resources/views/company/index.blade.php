<div class="card">
    <div class="card-header">{{ __('lang.companies') }}</div>

    <div class="card-body">
        
        <a href="javascript:void(0);" data-url="{{ route('company.create') }}" class="btn btn-warning float-right load_model_box" style="margin-bottom: 20px;">
            {{ __('lang.add_company') }}
        </a>

        <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('lang.name') }}</th>
                        <th scope="col">{{ __('lang.email') }}</th>
                        <th scope="col">{{ __('lang.website') }}</th>
                        <th scope="col">{{ __('lang.logo') }}</th>
                        <th scope="col">{{ __('lang.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                    <tr>
                        <th scope="row">{{ $company->id }}</th>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->website }}</td>
                        <td>@if(!empty($company->logo)) <img src="{{ asset('storage/images/company/'.$company->logo) }}" height="100" width="100"/> @endif</td>
                        <td>
                            <a href="javascript:void(0);" data-url="{{ route('company.show', ['id' => $company->id]) }}" class="btn btn-warning load_model_box">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </a>

                            <a href="javascript:void(0);" data-url="{{ route('company.edit', ['id' => $company->id]) }}" class="btn btn-primary load_model_box">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="javascript:void(0);" onclick="deleteRecord(this);" data-url="{{ route('company.destroy', ['id' => $company->id]) }}" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
        <div style="float: right;">
            {!! $companies->links() !!}
        </div>
        
        @include('common.model_box', ['modelTitle' => __('lang.company_details')])

    </div>
</div>

<script type="text/javascript">
    $(() => {
        
        $('.pagination a').on('click', (e) => {
            e.preventDefault();

            let _url = $(e.target).attr('href');

            $.get(_url, function(data, status){
                $('#module_content_container').html(data);
            });
        });

        $('.load_model_box').on('click', (e) => {
            e.preventDefault();
            
            let _url = $(e.target).data('url');
            
            $.get(_url, function(data, status){
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
                $.get("{{ route('company.index') }}", function(data, status){
                    $('#module_content_container').html(data);
                });
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

</script>