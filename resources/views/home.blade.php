@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>

                <div class="card-body">
                    <a href="javascript:void(0);" class="load_module_content" data-url="{{ route('company.index') }}" >{{ __('lang.companies') }}</a><br/>
                    <a href="javascript:void(0);" class="load_module_content" data-url="{{ route('employee.index') }}" >{{ __('lang.employees') }}</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-10">
            <div id="module_content_container">
                <!-- dynamic content from AJAX request for module populated here -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.load_module_content').on('click', (e) => {
        let _$this = $(e.target);
        let _url = _$this.data('url');
        
        $.get(_url, (data) => {
            $('#module_content_container').html(data);
        });
    });
</script>
@endsection
