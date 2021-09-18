@inject('commonHelper', 'App\Helpers\CommonHelper')
@php
    $companies = $commonHelper::getAllCompanies();
@endphp

<form class="form_container" action="{{ route('employee.store') }}" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="first_name" class="col-sm-3 col-form-label">{{ __('lang.first_name') }}:</label>
        <div class="col-sm-9">
            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="{{ __('lang.first_name') }}">
            <span style="display: none;" id="first_name_error" class="help-inline"></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="last_name" class="col-sm-3 col-form-label">{{ __('lang.last_name') }}:</label>
        <div class="col-sm-9">
            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="{{ __('lang.last_name') }}">
            <span style="display: none;" id="last_name_error" class="help-inline"></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">{{ __('lang.email') }}:</label>
        <div class="col-sm-9">
            <input type="text" name="email" class="form-control" id="email" placeholder="{{ __('lang.email') }}">
            <span style="display: none;" id="email_error" class="help-inline"></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-3 col-form-label">{{ __('lang.phone') }}:</label>
        <div class="col-sm-9">
            <input type="text" name="phone" class="form-control" id="phone" placeholder="{{ __('lang.phone') }}" maxlength="10">
        </div>
    </div>
    <div class="form-group row">
        <label for="country" class="col-sm-3 col-form-label">{{ __('lang.company') }}:</label>
        <div class="col-sm-9">
            <select name="company_id" id="country" class="form-control">
                <option value="" selected disabled>Choose Company</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <a class="btn btn-primary float-right submit_form">{{ __('lang.create') }}</a>
</form>

<script type="text/javascript">
    $('.submit_form').on('click', (e) => {
        
        let _$form = $(e.target).closest('form');
        let _formData = new FormData(_$form[0]);

        $.ajax({
            type: "POST",
            url: _$form.attr('action'),
            data: _formData,
            processData: false,
            contentType: false,
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(data) {
                if(data.status) {
                    $('#empModal').modal('hide');

                    $.get("{{ route('employee.index') }}", function(data, status){
                        $('#module_content_container').html(data);
                    });
                } else {
                    !!data.errors.first_name ? $('#first_name_error').show().text(data.errors.first_name[0]) : $('#first_name_error').hide().text('');
                    !!data.errors.last_name ? $('#last_name_error').show().text(data.errors.last_name[0]) : $('#last_name_error').hide().text('');
                    !!data.errors.email ? $('#email_error').show().text(data.errors.email[0]) : $('#email_error').hide().text('');
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
</script>