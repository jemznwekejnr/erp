<table class="table">
	<thead>
		<tr style="background-color: #0000ff; color: #fff;">
			<th>Date</th>
			<th>Title</th>
			<th>Project</th>
			<th>Net Amount (&#8358;)</th>
			<th>Created By</th>
			<th>Sent To</th>
			<th>CCs</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		@foreach($pvs as $pv)
		@if($pv->sendto == Auth::user()->profileid)
		@if($pv->submission == "Submit")
		<tr>
			<td>{{ $pv->created_at }}</td>
			<td>{{ $pv->title }}</td>
			<td>{{ app\Http\Controllers\Controller::projectname($pv->project) }}</td>
			<td>{{ number_format($pv->totalnet, 2) }}</td>
			<td>{{ app\Http\Controllers\Controller::staffname($pv->sentform) }}</td>
			<td>{{ app\Http\Controllers\Controller::staffname($pv->sendto) }}</td>
			<td>@if(!empty($pv->copies)) |
				@php $copy = explode(",", $pv->copies) @endphp
				@for($j=0; $j < count($copy); $j++)
				{{ app\Http\Controllers\Controller::staffname($copy[$j]) }} |
				@endfor
				@endif</td>
			<td>
				<a href="{{ url('pvdetails?id='.$pv->id) }}">@if($pv->status == "Pending")
				<button type="button" class="btn btn-warning btn-sm">{{ $pv->status }}</button>
				@elseif($pv->status == "Approved")
				<button type="button" class="btn btn-primary btn-sm">{{ $pv->status }}</button>
				@elseif($pv->status == "Paid")
				<button type="button" class="btn btn-success btn-sm">{{ $pv->status }}</button>
				@elseif($pv->status == "Rejected")
				<button type="button" class="btn btn-danger btn-sm">{{ $pv->status }}</button>
				@else
				<button type="button" class="btn btn-info btn-sm">{{ $pv->status }}</button>
				@endif</a>
				</td>
			
		</tr>
		@endif
		@else
		<tr>
			<td>{{ $pv->created_at }}</td>
			<td>{{ $pv->title }}</td>
			<td>{{ app\Http\Controllers\Controller::projectname($pv->project) }}</td>
			<td>{{ number_format($pv->totalnet, 2) }}</td>
			<td>{{ app\Http\Controllers\Controller::staffname($pv->sentform) }}</td>
			<td>{{ app\Http\Controllers\Controller::staffname($pv->sendto) }}</td>
			<td>@if(!empty($pv->copies)) |
				@php $copy = explode(",", $pv->copies) @endphp
				@for($j=0; $j < count($copy); $j++)
				{{ app\Http\Controllers\Controller::staffname($copy[$j]) }} |
				@endfor
				@endif</td>
			<td>
				<a href="{{ url('pvdetails?id='.$pv->id) }}">@if($pv->status == "Pending")
				<button type="button" class="btn btn-warning btn-sm">{{ $pv->status }}</button>
				@elseif($pv->status == "Approved")
				<button type="button" class="btn btn-primary btn-sm">{{ $pv->status }}</button>
				@elseif($pv->status == "Paid")
				<button type="button" class="btn btn-success btn-sm">{{ $pv->status }}</button>
				@elseif($pv->status == "Rejected")
				<button type="button" class="btn btn-danger btn-sm">{{ $pv->status }}</button>
				@else
				<button type="button" class="btn btn-info btn-sm">{{ $pv->status }}</button>
				@endif</a>
				</td>
			
		</tr>
		@endif
		@endforeach
	</tbody>
</table>
{!! $pvs->links() !!}