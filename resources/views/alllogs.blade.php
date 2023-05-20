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
							<h4 class="mb-0">All Notifications</h4>
						</div>
						<hr/>
						<div class="table-responsive">
							<table id="example" class="table table-striped" style="width:100%">
								<thead>
                                <tr style="background-color: #0000ff; color: #fff">
										<th>SN</th>
										<th>Date</th>
										<th>Staff</th>
										<th>Action</th>
									</tr>
							 </thead>
							 <tbody>
							 @php $notifications = app\Http\Controllers\Controller::notifications() @endphp

							 @php $x=1 @endphp
									@foreach($logs as $log)
									<tr>
										<td>{{ $x++ }}</td>
										<td>{{ $log->created_at }}</td>
										<td>{{ app\Http\Controllers\Controller::staffname($log->user) }}</td>
										<td>{{ $log->action }}</td>
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