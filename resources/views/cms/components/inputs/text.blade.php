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
	<div class="row">
		<div class="col">
			<label class="form-control-label">{{ $label }} @include('cms.components.inputs.asterix')</label>
		</div>
		@if(isset($maxlength) && $maxlength)
		<div class="col-auto align-self-end">
			<p class="length-js text-muted mb-0"><small><em><span>0</span> / {{ $maxlength }}</em></small></p>
		</div>
		@endif
	</div>
	
	<input @if(isset($type) && $type) type="{{ $type }}" @endif name="{{ $name }}" @if(isset($maxlength) && $maxlength) maxlength="{{ $maxlength }}" @endif class="form-control form-control-alternative {{ (isset($class) && $class ? $class : '') }}" value="{{ $component_value }}" @if(isset($class) && $class == 'slugify_slug' || isset($readonly) && $readonly) readonly @endif>
	
	@if(isset($hint) && $hint)
	<small>{{$hint}}</small>
	@endif

	@if(isset($class) && $class == 'slugify_slug')
	<small class="text-warning"><em>(This field will be automatically filled after writing in the <b>Title</b> field)</em></small>
	@endif

	@if(isset($text))
	<small><em>{{ $text }}</em></small>
	@endif

	@include('cms.components.inputs.error')
</div>