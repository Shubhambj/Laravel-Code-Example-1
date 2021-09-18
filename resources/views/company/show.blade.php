
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">{{ __('lang.name') }}:</label>
        <label class="col-sm-9 col-form-label">{{ $company->name }}</label>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">{{ __('lang.email') }}:</label>
        <label class="col-sm-9 col-form-label">{{ $company->email }}</label>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">{{ __('lang.website') }}:</label>
        <label class="col-sm-9 col-form-label">{{ $company->website }}</label>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">{{ __('lang.logo') }}:</label>
        <label class="col-sm-9 col-form-label">@if(!empty($company->logo)) <img src="{{ asset('storage/images/company/'.$company->logo) }}" height="100" width="100"/> @endif</label>
    </div>
