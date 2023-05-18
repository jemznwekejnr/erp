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
								<li class="breadcrumb-item active" aria-current="page">Edit Leave Application</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
		<div class="card" style="padding-bottom: 30px;">
		       <div class="col-12 col-lg-12">
		          <div class=" radius-10">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<div>
							<h4 class="mb-0">Leave Application Form</h4>
						</div>
						
					</div>
				</div>
				  <div class="card-body" style="padding-top: 30px;">
				  	<div class="form-body">
					 <form class="row g-3" action="submitleaveedit" id="submitleaveedit" method="post" enctype="multipart/form-data">
					 	@csrf
					 	<input type="hidden" name="id" value="{{ $leaves[0]->id }}">
					 	<div class="col-sm-12">
					 		<label for="inputFirstName" class="form-label">Title <span class="required" >*</span></label>
							<input type="text" class="form-control" id="title" name="title" placeholder="Leave Title" value="{{ $leaves[0]->title }}" maxlength="225" required>
					 	</div><br />
					 	<div class="col-sm-12">
					 	<div class="row g-3">
						 	<div class="col-sm-3">
								<label for="inputFirstName" class="form-label">Leave Type <span class="required" >*</span></label>
								<select name="leavetype" id="leavetype" class="form-control" required>
									<option value="{{ $leaves[0]->leavetype }}">{{ app\Http\Controllers\Controller::getleavename($leaves[0]->leavetype) }}</option>
									@foreach($leavetypes as $leavetype)
								    <option value="{{ $leavetype->id }}">{{ $leavetype->leavename }}</option>
								    @endforeach
								</select>
							</div>
						 	<div class="col-sm-3" id="leaveduration">
								@include("process.leaveduration")
							</div>
							<div class="col-sm-3">
								<label>Start Date</label>
								<input type="date" name="startdate" class="form-control" value="{{ $leaves[0]->startdate }}">
							</div>
							<div class="col-sm-3">
								<label>Resumption Date</label>
								<input type="date" name="enddate" class="form-control" value="{{ $leaves[0]->enddate }}">
							</div>
						</div>
					</div>
					<div class="col-sm-12">
					 	<div class="row g-3">
						 	<div class="col-sm-6">
								<label for="inputFirstName" class="form-label">Leave Recipient <span class="required" >*</span></label>
								<select name="sendto" id="recipient" class="form-control" required>
									<option value="{{ $leaves[0]->sendto }}">{{ app\Http\Controllers\Controller::staffname($leaves[0]->sendto) }}</option>
									@foreach($staffs as $staff)
								    @if(Auth::user()->name != $staff->firstname.' '.$staff->surname.' '.$staff->othername)
								    @if($staff->id != 1)
								    <option value="{{ $staff->id }}">{{ $staff->firstname.' '.$staff->surname.' '.$staff->othername }}</option>
								    @endif
								    @endif
								    @endforeach
								</select>
							</div>
						 	<div class="col-sm-6">
								<label for="inputFirstName" class="form-label">Leave CC</label>
								<select class=" form-control" name="copy" id="copy">
									<option value="{{ $leaves[0]->copy }}">{{ app\Http\Controllers\Controller::staffname($leaves[0]->copy) }}</option>
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
					 	<div class="col-sm-12">
					 		<label for="inputFirstName" class="form-label">Leave Body <span class="required" >*</span></label>
							<textarea class="form-control" id="leavebody" name="leavebody" placeholder="Body of Leave Application" maxlength="1000" style="height: 300px;" required>{{ $leaves[0]->body }}</textarea>
							

								
								
					 	</div>
					 	@if(!empty($leaves[0]->attachment))
					 	<p class="col-sm-12">
					 	<button class="btn btn-info" type="button" id="showattachment">Attachment Display</button>
					 	</p>
					 	<div class="col-sm-12" id="hideattachment" style="display: none;">
						 	<iframe src="{{ asset($leaves[0]->attachment) }}" width="100%" height="1000px"></iframe>
						</div>
						@endif<br /><br />
					 	<div class="col-sm-12">
						<div class="row g-3">
						 	<div class="col-sm-6">
						 		<label>Add Attachment</label>
								<input type="file" id="pics" name="attachment" class="form-control" accept=".pdf" placeholder="Select Attachment">
							</div>
						 	<div class="col-sm-6 text-right float-right">
								
							</div>
						</div>
					</div><br /><br />
					<div class="col-sm-12" style="margin-top: 50px;">
					 		
							<p id="signature"><img src="{{ asset(app\Http\Controllers\Controller::staffsignature(Auth::user()->profileid)) }}" width="150px"></p>
							<p id="sender"><b>{{ app\Http\Controllers\Controller::staffname(Auth::user()->profileid) }}</b></p>
								
					 	</div>
					 	<br /><br />
						<div class="col-sm-12">
						<div class="row g-3">
						 	<div class="col-sm-6">
								
							</div>
						 	<div class="col-sm-6 text-right float-right">
								<button class="btn btn-info" type="submit" id="button">Submit</button>
								<img src="{{ asset('assets/images/processing.gif') }}" width="50px;" id="processing" class="processing" style="display: none;">
							</div>
						</div>
					</div><br /><br />
						
					 </form>
					 </div>
				  </div>
			  </div>
		   </div>
		</div>
	</div>
</div>
<!--end page wrapper -->
@include("layouts.app-footer")
@include('process.leave')