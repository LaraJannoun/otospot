<div class="form-group">
	<label class="form-control-label">{{ $label }} @include('cms.components.inputs.asterix')</label>
	<select class="select2-custom form-control form-custom" name="{{ $name }}[]" multiple="">
		@foreach($rows as $select_row)
		<option value="{{ $select_row['id'] }}" @if(isset($row->$name) && empty(old($name))) @foreach($row->$name as $single) @if($single->pivot->$pivot == $select_row['id']) selected @endif @endforeach @endif @if(collect(old($name))->contains($select_row['id'])) selected @endif>{{ $select_row[$attribute] }}</option>
		@endforeach
	</select>

	@include('cms.components.inputs.error')
</div>