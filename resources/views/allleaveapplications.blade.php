@include("layouts.app-title")
<body>
@include("layouts.app-sidebar")
@include("layouts.app-header")
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		

		<div class="card">
					<div class="card-body">
						<div class="card-title">
							<h4 class="mb-0">Leave Applications</h4>
						</div>
						<hr/>
						<div class="table-responsive">
							<table id="example" class="table table-striped" style="width:100%">
								<thead>
									<tr style="background-color: #0000ff; color: #fff">
										<th>Date</th>
										<th>Title</th>
										<th>Days Taken</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Previous Leave</th>
										<th>Days Left</th>
										<th>Sender</th>
										<th>Recipient</th>
										<th>CC</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach($leaves as $leave)
									<tr>
										<td>{{ $leave->created_at }}</td>
										<td><a href="{{ url('leavedetails?id='.$leave->id) }}">{{ $leave->title }} @if(!empty($leave->attachment)) <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"><path fill="currentColor" d="M0 4.5V0h1v4.5a1.5 1.5 0 1 0 3 0v-3a.5.5 0 0 0-1 0V5H2V1.5a1.5 1.5 0 1 1 3 0v3a2.5 2.5 0 0 1-5 0Z"/><path fill="currentColor" fill-rule="evenodd" d="M12.5 0H6v4.5A3.5 3.5 0 0 1 2.5 8H1v5.5A1.5 1.5 0 0 0 2.5 15h10a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 0ZM11 4H7v1h4V4Zm0 3H7v1h4V7Zm-7 3h7v1H4v-1Z" clip-rule="evenodd"/></svg> @endif</a></td>
										<td>{{ $leave->duration }}</td>
										<td>{{ $leave->startdate }}</td>
										<td>{{ $leave->enddate }}</td>
										<td>{{ $leave->daystaken }}</td>
										<td>{{ $leave->daysleft }}</td>
										<td>{{ app\Http\Controllers\Controller::staffname($leave->staff) }}</td>
										<td>{{ app\Http\Controllers\Controller::staffname($leave->sendto) }}</td>
										<td>{{ app\Http\Controllers\Controller::staffname($leave->copy) }}</td>
										<td><a href="{{ url('leavedetails?id='.$leave->id) }}">@if($leave->status == 'Pending') <button class="btn btn-warning btn-sm">{{ $leave->status }}</button> @elseif($leave->status == 'Approved') <button class="btn btn-success btn-sm">{{ $leave->status }}</button> @elseif($leave->status == 'Rejected') <button class="btn btn-danger btn-sm">{{ $leave->status }}</button>  @else <button class="btn btn-primary btn-sm convertuser">
										{{ $leave->status }}</button> 
										@endif</a></td>
										
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
	</div>
</div>
<!--end page wrapper -->
@include("layouts.app-footer")