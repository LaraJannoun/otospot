<!-- <div class="row align-items-center">
    <div class="col-lg">
        <div class="copyright text-center text-md-left text-muted">
            &copy; {{ date('Y') }} Powered by<a href="{{ env('POWERED_BY_LINK') }}" class="font-weight-bold ml-1" target="_blank">{{ env('POWERED_BY') }}</a>
        </div>
    </div>
    <div class="col-lg text-center text-md-right">
    	<small class="text-muted"><em>"Simplicity is the soul of efficiency." - <b class="font-weight-bold">Austin Freeman</b></em></small>
    </div>
</div> -->
@if(Route::is('admin.login'))
<div style="position: absolute;bottom: -10px;left: -30px;">
    <img style="width:400px" src="{{ asset('assets-web/images/plant.svg') }}" alt="Otospot"/>
</div>
@endif
