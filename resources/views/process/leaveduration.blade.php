<label>Leave Duration (Days)</label>
<select name="duration" id="duration" class="form-control">
	<option>{{ $leaves[0]->daystaken ?? 'Select Duration' }}</option>
	@isset($duration)
	@for($i=1; $i<=$duration; $i++)
	<option>{{ $i }}</option>
	@endfor
	@endisset
</select>