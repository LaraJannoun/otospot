@php
if(isset($value) && $value){
	$component_value = old($name, $value);
} elseif(isset($row->$name) && $row->$name){
	$component_value = old($name, $row->$name);
} else {
	$component_value = old($name);
}
@endphp

<div class="form-group">
	<label class="form-control-label">{{ $label }} @include('cms.components.inputs.asterix')</label>
	<textarea name="{{ $name }}" @if(isset($maxlength) && $maxlength) maxlength="{{ $maxlength }}" @endif class="form-control form-control-alternative {{ (isset($quill) && $quill ? 'quill' : '') }}">{{ $component_value }}</textarea>

	<div class="row">
		<div class="col">
			@include('cms.components.inputs.error')
		</div>
		<div class="col-auto">
			@if(isset($maxlength) && $maxlength)
			<p class="length-js text-muted text-right px-3 mb-0"><small><em><span>0</span> / {{ $maxlength }}</em></small></p>
			@endif
		</div>
	</div>
</div>