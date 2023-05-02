<x-layout>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Training</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0" style="background-color: transparent;">
								<li class="breadcrumb-item"><a href="/mytrainings"><i class="bx bx-user"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Training Request</li>
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
								<h5 class="mb-0">Edit {{$training->description}} Training Request</h5>
								<p>Kindly fill in the form below to submit a Training request</p>
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
							<x-flash-message />
							<form class="row g-3" action="/edittraining{{$training->id}}" id="trainingcreate" method="post"  enctype="multipart/form-data">
								@csrf
                                @method('PUT')
			
								

								<div class="row my-3">
                                    <div class="col-sm-4">
										<label for="description" class="form-label">Training Description<small style="color:#ff0000">*</small></label>
										<input type="text" class="form-control" id="description" name="description" placeholder="Budget of Description"  value="{{$training->description}}"  required>
										@error('description')
											<p class="text-red-500  text-danger  text-xs mt-1">{{$message}}</p>
											@enderror
									</div>
                                    	<div class="col-sm-4">
														<label for="training_type" class="form-label">Training Type</label>
														<select class="form-control" id="training_type" name="training_type">
															<option value="">Select Training Type</option>
														
															<option @php if($training->training_type=="management") echo "selected"; @endphp value="management">Management Training</option>
															<option  @php if($training->training_type=="staff") echo "selected"; @endphp value="staff">Staff Training</option>
															
														</select>
														@error('training_type')
															<p class="text-red-500   text-danger  text-xs mt-1">{{$message}}</p>
															@enderror
											</div>

									<div class="col-sm-4">
										<label for="duration" class="form-label">Training Duration<small style="color:#ff0000">*</small></label>
										<input type="number" class="form-control" id="duration" name="duration" placeholder="Training Duration (In days)"  value="{{$training->duration}}"  required>
										@error('number')
											<p class="text-red-500  text-danger  text-xs mt-1">{{$message}}</p>
											@enderror
									</div>
									
									
									
								</div><br />
							
							<div class="row my-3">
									  <div class="col-sm-4">
														<label for="training_date" class="form-label">Start Date<small style="color:#ff0000">*</small></label>
															
														<input type="date" class="form-control" id="training_date" name="training_date"  placeholder="Choose Training date" value="{{$training->training_date}}"  required >
														@error('training_date')
															<p class="text-red-500  text-danger  text-xs mt-1">{{$message}}</p>
															@enderror
									</div>
                                    <div class="col-sm-4">
														<label for="training_mode" class="form-label">Training Mode</label>
														<select class="form-control" id="training_mode" name="training_mode">
															<option value="">Select Mode</option>
														
															<option @php if($training->training_mode=="online") echo "selected"; @endphp  value="online">Online</option>
															<option @php if($training->training_mode=="offline") echo "selected"; @endphp  value="offline">Offline</option>
															
														</select>
														@error('training_type')
															<p class="text-red-500   text-danger  text-xs mt-1">{{$message}}</p>
															@enderror


									</div>
								   <div class="col-sm-4">
                                    @php  
                                    
                                    $trainees = explode(",",$training->trainees);
                                     @endphp
                                        <label for="trainees" class="form-label">Staff(s) to be Trained</label>
                                        <select data-placeholder="Begin typing a name to filter..." multiple class=" form-control" name="trainees[]">
                                            <option value=""></option>
                                            @foreach($staffs as $staff)
                                            @if(Auth::user()->name != $staff->firstname.' '.$staff->surname.' '.$staff->othername)
                                            @if($staff->id != 1)
                                            <option  @if(in_array($staff->id, $trainees)) {{"selected"}} @endif value="{{ $staff->id }}">{{ $staff->firstname.' '.$staff->surname.' '.$staff->othername }}</option>
                                            @endif
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('trainees')
															<p class="text-red-500   text-danger  text-xs mt-1">{{$message}}</p>
											@enderror
                                    </div>

									

									
							
								</div>
								<br />



										
			
								
				
								
							
								
							
								<div class="row">
									<div class="col-sm-6">
										
									</div>
									<div class="col-sm-6 text-right float-right">
										<button class="btn btn-info" type="submit" id="button">Edit</button>
										<img src="{{ asset('assets/images/processing.gif') }}" width="50px;" id="processing" class="processing" style="display: none;">
									</div>
								</div><br />
							
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
			title: 'Are you sure you want to edit this Training Request?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, Edit !',
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