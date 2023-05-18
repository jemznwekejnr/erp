<x-layout>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Logistics</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0" style="background-color: transparent;">
								<li class="breadcrumb-item"><a href="/logistics"><i class="bx bx-user"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add New Logistic Request</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
		<div class="row">
		       <div class="col-12 col-lg-12">
		          <div class="card radius-10">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<div>
							<h5 class="mb-0">Logisitc Request</h5>
                            <p>Kindly fill in the form below to submit a logistics request</p>
						</div>
						<div class="dropdown ms-auto">
							<!--<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
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
							</ul>-->
						</div>
					</div>
				</div>
				  <div class="card-body" style="padding-top: 40px;">
				  	<div class="form-body">
					 <form class="row g-3" action="/logisticcreate" id="submitstaff" method="post"  enctype="multipart/form-data" >
					 	@csrf

       
					 	
			<div class="col-sm-12">
					 	<div class="row">
						 	<div class="col-sm-4">
								<label for="title" class="form-label">Request Title<small style="color:#ff0000">*</small></label>
								<input type="text" class="form-control" id="title" name="title" placeholder="title of Request"  value="{{old('title')}}"  required>
                                 @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
                            <div class="col-sm-4">
								<label for="title" class="form-label">Request Purpose<small style="color:#ff0000">*</small></label>
								<input type="text" class="form-control" id="purpose" name="purpose" placeholder="Purpose of Request"  value="{{old('purpose')}}"  required>
                                 @error('purpose')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
                            <div class="col-sm-4">
								<label for="amount" class="form-label">Amount<small style="color:#ff0000">*</small></label>
								<input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount"  value="{{old('amount')}}"  required>
                                 @error('amount')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
						 	
						</div><br />
                  <div class="row">
                        <div class="col-sm-4">
								<label for="date" class="form-label">Requested By<small style="color:#ff0000">*</small></label>
								<input type="text" class="form-control" id="dte" name="req" placeholder="{{Auth::user()->name}}"  value="" disabled>
                                <input type="text" class="form-control" id="requested_by" name="requested_by" placeholder=""  value="{{Auth::user()->profileid}}" hidden >
                                
						</div>

                        <div class="col-sm-4">
								<label for="sent_to" class="form-label">Send To</label>
								<select class="form-control" id="sent_to" name="sent_to">
									<option value="">Select Staff</option>
									@foreach($staffs as $staff)
									<option value="{{$staff->id}}">{{ $staff->surname }} {{$staff->firstname}}</option>
									@endforeach
                                    
								</select>
                                 @error('sent_to')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
					    </div>

				
						<div class="col-sm-4">
							<label for="start date" class="form-label">Start Date</label>
								
							<input type="date" class="form-control" id="start_date" name="start_date"  placeholder="Choose date" value="{{old('start_date')}}"  required >
							@error('start_date')
								<p class="text-red-500 text-xs mt-1">{{$message}}</p>
								@enderror
						</div>
                    
	             </div>
                        <br />


					<div class="row">
                           <div class="col-sm-4">
								<label for="end_date" class="form-label">End Date</label>
                                	
								<input type="date" class="form-control" id="end_date" name="end_date"  placeholder="Choose date" value="{{old('end_date')}}"  required >
                                 @error('end_date')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
			       	       </div>
						   <div class="col-sm-4">
								<label for="end_date" class="form-label">Attachment<small style="color:#ff0000"> (optional)</small></label>
                                	
								<input type="file" class="form-control" name="files[]" multiple >
                                 @error('attachment')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
			       	       </div>
                          
					</div><br />
					<div class="row">
                        <div class="col-sm-12" style="margin-top: 50px;">
					 		
							<p id="signature"><img src="{{ asset(app\Http\Controllers\Controller::staffsignature(Auth::user()->profileid)) }}" width="150px"></p>
							<p id="sender"><b>{{ app\Http\Controllers\Controller::staffname(Auth::user()->profileid) }}</b></p>
								
					 	</div>
					 	<br /><br />
					</div>
						
					
						
                       
						<div class="row">
						 	<div class="col-sm-6">
								
							</div>
						 	<div class="col-sm-6 text-right float-right">
								<button class="btn btn-info" type="submit" id="button">Submit</button>
								<img src="{{ asset('assets/images/processing.gif') }}" width="50px;" id="processing" class="processing" style="display: none;">
							</div>
						</div><br />
						</div>
					 </form>
					 </div>
				  </div>
			  </div>
		   </div>
		</div>
	</div>
</div>
</x-layout>
<script>


	$('form').submit(function(event) {
    event.preventDefault(); // prevent the form from submitting
     $("#button").hide();
	$("#processing").show();
	
			const swalWithBootstrapButtons = Swal.mixin({
						customClass: {
							confirmButton: 'btn btn-success',
							cancelButton: 'btn btn-danger'
						},
						buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
			title: 'Are you sure you want to send Logistics Request?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, Request !',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
			}).then((result) => {
			if (result.isConfirmed) {
				$(this).unbind('submit').submit();
				swalWithBootstrapButtons.fire(
				'Sending Logistics Request',
				'...',
				''
				)
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
				
			) {
				swalWithBootstrapButtons.fire(
				'Cancelled',
				'You Cancelled this Operation :)',
				'error'
				)
				$("#button").show();
				$("#processing").hide();
			}
			})


});

</script>