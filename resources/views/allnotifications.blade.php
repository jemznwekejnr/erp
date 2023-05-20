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
										<th>Date</th>
										<th>Type</th>
										<th>Title</th>
										<th>Action</th>
									</tr>
							 </thead>
							 <tbody>
							 @php $notifications = app\Http\Controllers\Controller::notifications() @endphp

							 @php $x=1 @endphp
									@foreach($notifications as $notification)
									<tr>
										<td>{{ $notification->created_at }}</td>
										<td>{{ $notification->type }}</td>
										<td>{{ $notification->title }}</td>
										<td><a href="{{ $notification->location }}" class="btn btn-primary btn-sm">View</a></td>
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