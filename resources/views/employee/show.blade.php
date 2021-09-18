
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">{{ __('lang.first_name') }}:</label>
        <label class="col-sm-9 col-form-label">{{ $employee->first_name }}</label>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">{{ __('lang.last_name') }}:</label>
        <label class="col-sm-9 col-form-label">{{ $employee->last_name }}</label>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">{{ __('lang.email') }}:</label>
        <label class="col-sm-9 col-form-label">{{ $employee->email }}</label>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">{{ __('lang.phone') }}:</label>
        <label class="col-sm-9 col-form-label">{{ $employee->phone }}</label>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">{{ __('lang.company') }}:</label>
        <label class="col-sm-9 col-form-label">{{ $employee->companyName }}</label>
    </div>