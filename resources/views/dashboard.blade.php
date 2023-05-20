@include("layouts.app-title")
<body>
@include("layouts.app-sidebar")
@include("layouts.app-header")
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
					<div class="col">
						<div class="card radius-10 border-warning border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Total Projects</p>
										<h4 class="my-1 text-warning">{{ app\Http\Controllers\Controller::totalprojects() }}</h4>
									</div>
									<div class="text-warning ms-auto font-35"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="currentColor" d="M12 22c3.976 0 8-1.374 8-4V6c0-2.626-4.024-4-8-4S4 3.374 4 6v12c0 2.626 4.024 4 8 4zm0-2c-3.722 0-6-1.295-6-2v-1.268C7.541 17.57 9.777 18 12 18s4.459-.43 6-1.268V18c0 .705-2.278 2-6 2zm0-16c3.722 0 6 1.295 6 2s-2.278 2-6 2s-6-1.295-6-2s2.278-2 6-2zM6 8.732C7.541 9.57 9.777 10 12 10s4.459-.43 6-1.268V10c0 .705-2.278 2-6 2s-6-1.295-6-2V8.732zm0 4C7.541 13.57 9.777 14 12 14s4.459-.43 6-1.268V14c0 .705-2.278 2-6 2s-6-1.295-6-2v-1.268z"/></svg>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 border-danger border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Pending Projects</p>
										<h4 class="my-1 text-danger">{{ app\Http\Controllers\Controller::pendingprojects() }}</h4>
									</div>
									<div class="text-danger ms-auto font-35"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="currentColor" d="M18 2H6c-1.103 0-2 .897-2 2v17a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4c0-1.103-.897-2-2-2zm0 18H6V4h12v16z"/><path fill="currentColor" d="M8 6h3v2H8zm5 0h3v2h-3zm-5 4h3v2H8zm5 .031h3V12h-3zM8 14h3v2H8zm5 0h3v2h-3z"/></svg>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 border-primary border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Ongoing Projects</p>
										<h4 class="my-1 text-primary">{{ app\Http\Controllers\Controller::ongoingprojects() }}</h4>
									</div>
									<div class="text-primary ms-auto font-35"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="currentColor" d="M19 2H9c-1.103 0-2 .897-2 2v6H5c-1.103 0-2 .897-2 2v9a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V4c0-1.103-.897-2-2-2zM5 12h6v8H5v-8zm14 8h-6v-8c0-1.103-.897-2-2-2H9V4h10v16z"/><path fill="currentColor" d="M11 6h2v2h-2zm4 0h2v2h-2zm0 4.031h2V12h-2zM15 14h2v2h-2zm-8 .001h2v2H7z"/></svg>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10  border-success border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Completed Projects</p>
										<h4 class="text-success my-1">{{ app\Http\Controllers\Controller::completedprojects() }}</h4>
									</div>
									<div class="text-success ms-auto font-35"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="currentColor" d="M19 2H9c-1.103 0-2 .897-2 2v5.586l-4.707 4.707A1 1 0 0 0 3 16v5a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V4c0-1.103-.897-2-2-2zm-8 18H5v-5.586l3-3l3 3V20zm8 0h-6v-4a.999.999 0 0 0 .707-1.707L9 9.586V4h10v16z"/><path fill="currentColor" d="M11 6h2v2h-2zm4 0h2v2h-2zm0 4.031h2V12h-2zM15 14h2v2h-2zm-8 1h2v2H7z"/></svg>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!--end row-->

				<div class="row">
                   <div class="col-12 col-lg-8">
                      <div class="card radius-10">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Project Completion Status by Tasks Assigned</h6>
								</div>
								<div class="dropdown ms-auto">
									<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
									</a>
									<ul class="dropdown-menu">
									</ul>
								</div>
							</div>
						</div>
						  <div class="card-body">
							<div class="chart-container-0">
							@include('charts.projectstatus')
							<div id="columnchart_material" style="width: 100%; height: 300px;"></div>
							  </div>
						  </div>
					  </div>
				   </div>
				   <div class="col-12 col-lg-4">
                       <div class="card radius-10">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Overall Project Status</h6>
								</div>
								<div class="dropdown ms-auto">
									<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
									</a>
									<ul class="dropdown-menu">
									</ul>
								</div>
							</div>
						</div>
						   <div class="card-body">
							<div class="chart-container-0">
							@include('charts.projectcompletion')
							<div id="piechart" style="width: 100%; height: 300px;"></div>
							  </div>
						   </div>
					   </div>
				   </div>
				</div><!--end row-->
				

				 <div class="card radius-10">
                         <div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Recently Unread Notifications</h6>
								</div>
								<div class="dropdown ms-auto">
									<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="{{ url('allnotifications') }}">View All</a>
										</li>
										<li>
											<hr class="dropdown-divider">
										</li>
									</ul>
								</div>
							</div>
						 <div class="table-responsive">
						   <table class="table table-striped align-middle mb-0">
							<thead class="">
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
									@if($x <= 5)
									<tr>
										<td>{{ $notification->created_at }}</td>
										<td>{{ $notification->type }}</td>
										<td>{{ $notification->title }}</td>
										<td><a href="{{ $notification->location }}" class="btn btn-primary btn-sm">View</a></td>
									</tr>
									@php $x++ @endphp
									@endif
									@endforeach
						    </tbody>
						  </table>
						  </div>
						 </div>
					  </div>

					  <!--<div class="card radius-10 w-100">
						<div class="card-header bg-transparent">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">World Map</h6>
								</div>
								<div class="dropdown ms-auto">
									<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="javascript:;">Action</a>
										</li>
										<li><a class="dropdown-item" href="javascript:;">Another action</a>
										</li>
										<li>
											<hr class="dropdown-divider">
										</li>
										<li><a class="dropdown-item" href="javascript:;">Something else here</a>
										</li>
									</ul>
								</div>
							</div>
						   </div>
						<div class="card-body">
							<div id="geographic-map-2"></div>
						 </div>
					   </div>-->

			</div>
		</div>
		<!--end page wrapper -->
@include("layouts.app-footer")