<form class="form_container" action="{{ route('company.update', ['id' => $company->id]) }}" enctype="multipart/form-data">
    @method('PUT')
    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">{{ __('lang.name') }}:</label>
        <div class="col-sm-9">
            <input type="text" name="name" class="form-control" id="name" value="{{ $company->name }}" placeholder="{{ __('lang.name') }}">
            <span style="display: none;" id="name_error" class="help-inline"></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">{{ __('lang.email') }}:</label>
        <div class="col-sm-9">
            <input type="text" name="email" class="form-control" id="email" value="{{ $company->email }}" placeholder="{{ __('lang.email') }}">
            <span style="display: none;" id="email_error" class="help-inline"></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="website" class="col-sm-3 col-form-label">{{ __('lang.website') }}:</label>
        <div class="col-sm-9">
            <input type="text" name="website" class="form-control" id="website" value="{{ $company->website }}" placeholder="{{ __('lang.website') }}">
        </div>
    </div>
    <div class="form-group row">
        <label for="logo" class="col-sm-3 col-form-label">{{ __('lang.logo') }}:</label>
        <div class="col-sm-9">
            <input type="file" name="logo" class="form-control" id="logo" placeholder="{{ __('lang.logo') }}" maxlength="10">
            <span style="display: none;" id="logo_error" class="help-inline"></span>
        </div>
    </div>
    
    <a href="javascript:void(0);" onclick="submitForm(this, callback)" class="btn btn-primary float-right submit_form">{{ __('lang.update') }}</a>
</form>

<script type="text/javascript">
    function callback(data) {
        if(data.status) {
            $('#commonModal').modal('hide');

            $.get("{{ route('company.index') }}", function(data, status){
                $('#module_content_container').html(data);
            });
        } else {
            !!data.errors.name ? $('#name_error').show().text(data.errors.name[0]) : $('#name_error').hide().text('');
            !!data.errors.email ? $('#email_error').show().text(data.errors.email[0]) : $('#email_error').hide().text('');
            !!data.errors.logo ? $('#logo_error').show().text(data.errors.logo[0]) : $('#logo_error').hide().text('');
        }
    }
</script>