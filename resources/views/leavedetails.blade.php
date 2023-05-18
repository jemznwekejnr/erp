@include("layouts.app-title")
<body>
@include("layouts.app-sidebar")
@include("layouts.app-header")
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Leave</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0" style="background-color: transparent;">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-copy"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Leave Application</li>
							</ol>
						</nav>
					</div>
						<div class="col-sm-4 text-right float-right ms-auto">
							Status: @if($leaves[0]->status == 'Pending') <button class="btn btn-warning btn-sm">{{ $leaves[0]->status }}</button> @elseif($leaves[0]->status == 'Approved') <button class="btn btn-success btn-sm">{{ $leaves[0]->status }}</button> @elseif($leaves[0]->status == 'Rejected') <button class="btn btn-danger btn-sm">{{ $leaves[0]->status }}</button>  @else <button class="btn btn-primary btn-sm convertuser">{{ $leaves[0]->status }}</button>@endif
						
					</div>
				</div>
				<!--end breadcrumb-->
		<div class="card" style="padding-bottom: 30px;">
		       <div class="col-12 col-lg-12">
		          <div class=" radius-10">
				<div class="card-header">
						<div class="d-flex align-items-center">
						<div>
							<h4 class="mb-0">Leave Application Details</h4>
						</div>
						<div class="dropdown ms-auto">
							<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
							</a>
							<ul class="dropdown-menu">
								
								@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 1, 7) == "allow")
								@if(($leaves[0]->status == "Pending" || $leaves[0]->status == "Rejected") && $leaves[0]->staff == Auth::user()->profileid)
								<li><a class="dropdown-item" href="{{ url('editleaverequest?id='.$leaves[0]->id) }}">Edit Leave</a>
								</li>
								@endif
								@endif
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item" href="{{ url('dashboard') }}">Back to Dashboard</a>
								</li>
							</ul>
						</div>
					</div>
						

					


				</div>
				  <div class="card-body" style="padding-top: 30px;">
				  	<div class="form-body">
					 	<div class="col-sm-12">
					 		<label>Title</label>
							<p class="form-control">{{ $leaves[0]->title }}</p>
					 	</div><br />
					 	<div class="col-sm-12">
					 	<div class="row g-3">
						 	<div class="col-sm-4">
								<label>Leave Type</label>
								<p class="form-control">{{ app\Http\Controllers\Controller::getleavename($leaves[0]->leavetype) }}</p>
							</div>
						 	<div class="col-sm-4">
						 		<label>Previous Leave</label>
								<p class="form-control">{{ $leaves[0]->daystaken }}days</p>
							</div>
							<div class="col-sm-4">
								<label>Days Left</label>
								<p class="form-control">{{ $leaves[0]->daysleft }}</p>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
					 	<div class="row g-3">
						 	<div class="col-sm-4">
						 		<label>Leave Duration</label>
								<p class="form-control">{{ $leaves[0]->duration }}days</p>
							</div>
							<div class="col-sm-4">
								<label>Start Date</label>
								<p class="form-control">{{ $leaves[0]->startdate }}</p>
							</div>
							<div class="col-sm-4">
								<label>Resumption Date</label>
								<p class="form-control">{{ $leaves[0]->enddate }}</p>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
					 	<div class="row g-3">
						 	<div class="col-sm-4">
								<label>Send From</label>
								<p class="form-control">{{ app\Http\Controllers\Controller::staffname($leaves[0]->staff) }}</p>
							</div>
							<div class="col-sm-4">
								<label>Send To</label>
								<p class="form-control">{{ app\Http\Controllers\Controller::staffname($leaves[0]->sendto) }}</p>
							</div>
						 	<div class="col-sm-4">
								<label>Leave CC</label>
								<p class="form-control">{{ app\Http\Controllers\Controller::staffname($leaves[0]->copy) }}</p>
							</div>
						</div>
					</div>
					
					 	<div class="col-sm-12">
					 		<label for="inputFirstName" class="form-label">Leave Body <span class="required" ></span></label>
							<p class="form-control" style="height: 150px; overflow: scroll;">{{ $leaves[0]->body }}</p>
							
					 	</div>
					 	@if(!empty($leaves[0]->attachment))
					 	<p class="col-sm-12">
					 	<button class="btn btn-info" type="button" id="showattachment">Attachment Display</button>
					 	</p>
					 	<div class="col-sm-12" id="hideattachment" style="display: none;">
						 	<iframe src="{{ asset($leaves[0]->attachment) }}" width="100%" height="1000px"></iframe>
						</div>
						@endif<br /><br />
						
						<div class="col-sm-12" style="margin-top: 50px;">
					 		
							<p id="signature"><img src="{{ asset(app\Http\Controllers\Controller::staffsignature($leaves[0]->sendto)) }}" width="150px"></p>
							<p id="sender"><b>{{ app\Http\Controllers\Controller::staffname($leaves[0]->sendto) }}</b></p>
								
					 	</div>

					 	<br /><br />
						<div class="statuses">
							<div class="col-sm-12"  style="background-color: #0000ff !important; padding-top: 20px !important; color: #fff; margin-top: 30px;">
					 	<div class="row g-3">
						 	<div class="col-sm-4">
								<label>Status</label>
								<p class="form-control" style="background-color: #0000ff !important; color: #fff;">{{ $leaves[0]->status }}</p>
							</div>
							<div class="col-sm-3">
								<label>Hand Over</label>
								<p class="form-control" style="background-color: #0000ff !important; color: #fff;">{{ $leaves[0]->handover }}</p>
							</div>
						 	<div class="col-sm-5">
								<label>Stand In</label>
								<p class="form-control" style="background-color: #0000ff !important; color: #fff;">@if(!empty($leaves[0]->standin)){{ app\Http\Controllers\Controller::staffname($leaves[0]->standin) }}@endif</p>
							</div>
						</div>
					</div>
					<div class="col-sm-12" style="background-color: #0000ff !important; color: #fff; padding: 10px !important;">
					 	<div class="row g-3">
						 	<div class="col-sm-12">
								<label>Remark</label>
								<p class="form-control" style="background-color: #0000ff !important; color: #fff;">{{ $leaves[0]->remark }}</p>
							</div>
						</div>
					</div>
						</div>
					 </div>
				  </div>
			  </div>
		   </div>
		</div>
	</div>

	@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 1, 1) == "allow" || app\Http\Controllers\Controller::checkrole(Auth::user()->role, 1, 3) == "allow" || app\Http\Controllers\Controller::checkrole(Auth::user()->role, 1, 4) == "allow")
						<form action="leavereaction" id="leavereaction" method="post">
						@csrf
						<div class="card" style="padding-bottom: 30px;">
									<div class="card-body">
										<div class="card-header">
											<h4 class="mb-0">Update Leave Status</h4>
										</div>
										
										<input type="hidden" name="id" value="{{ $leaves[0]->id }}">
										<input type="hidden" name="sentfrom" value="{{ $leaves[0]->staff }}">
										<input type="hidden" name="title" value="{{ $leaves[0]->title }}">
										<div class="col-sm-12" style="padding-top: 20px;">
										<div class="row g-3">
										 	<div class="col-sm-4">
										 		<label for="inputFirstName" class="form-label">Status</label>
												<select name="status" id="status" class="form-control" required>
													<option>{{ $leaves[0]->status }}</option>
													<option>Cleared</option>
													<option>Approved</option>
													<option>Rejected</option>
													<option>Pending</option>
												</select>
											</div>
										 	<div class="col-sm-4">
										 		<label for="inputFirstName" class="form-label">Handover ?</label>
												<select name="handover" id="handover" class="form-control" required>
													<option>{{ $leaves[0]->handover }}</option>
													<option>Yes</option>
													<option>No</option>
												</select>
											</div>
											<div class="col-sm-4">
										 		<label>Stand In</label>
												<select name="standin" id="standin" class="form-control" required>
													<option value="{{ $leaves[0]->standin }}">@if(!empty($leaves[0]->standin)){{ app\Http\Controllers\Controller::staffname($leaves[0]->standin) }}@endif</option>
													@foreach($staffs as $staff)
												    @if(Auth::user()->name != $staff->firstname.' '.$staff->surname.' '.$staff->othername)
												    @if($staff->id != 1)
												    <option value="{{ $staff->id }}">{{ $staff->firstname.' '.$staff->surname.' '.$staff->othername }}</option>
												    @endif
												    @endif
												    @endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-12" style="padding-top: 20px;">
										<div class="row g-3">
											<div class="col-sm-11">
										 		<label for="inputFirstName" class="form-label">Remark</label>
												<input type="text" name="remarks" class="form-control" placeholder="Remark" value="{{ $leaves[0]->remark }}" required>
											</div>
										 	<div class="col-sm-1 text-right float-right">
										 		<label for="inputFirstName" class="form-label"><br /></label>
												<button class="btn btn-info" type="submit" id="button">Submit</button>
												<img src="{{ asset('assets/images/processing.gif') }}" width="50px;" id="processing" class="processing" style="display: none;">
											</div>
										</div>
									</div><br /><br />
									</div>
								</div>
						</form>
						@endif
</div>
<!--end page wrapper -->
@include("layouts.app-footer")
@include('process.leave')