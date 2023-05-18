<?php

use App\Models\Stock;
use App\Models\User;

?>
<x-layout>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3"> Stock Requests</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0" style="background-color: transparent;">
								<li class="breadcrumb-item"><a href="/mystockrequest"><i class="bx bx-user"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Request for Stock</li>
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
												<h5 class="mb-0">Edit {{$stockrequest->stock->name}} Stock Request</h5>
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
										<x-flash-message />
										<div class="form-body">
										<form class="row g-3" action="/mystockrequestedit{{$stockrequest->id}}" id="submitstock" method="post" enctype="multipart/form-data">
											@csrf
                                            @method('PUT')
											<div class="col-sm-4">
											<center>



												<!--image upload starts here--->
															<div class="fileinput fileinput-new text-center" data-provides="fileinput">
																<div class="fileinput-new  avatar border-gray">
																<img src="@if(is_null($stockrequest->stock->image)){{asset("assets/images/signature.jpg")}} @else {{asset($stockrequest->stock->image)}} @endif" width="250px" alt="..." id="stock_image">
																</div>
															
																<div>
																	
																<!--<span class="btn btn-round btn-rose btn-file">
																	<span class="fileinput-new">Add Photo</span>
																	<span class="fileinput-exists">Change</span>
																	<input type="file" name="pics" id="pics" />
																</span>
																<br />
																<a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>-->
																</div>
																
															</div><br /><br />



												<


												
											</center>
											</div>
											<div class="col-sm-8">
											
											<div class="row my-5">

												<div class="col-sm-6">
													<label for="inputCategory" class="form-label">Select Stock Item <small style="color:#ff0000">*</small></label>
													<select class="form-control" id="stock_id" name="stock_id">
														<option value="">Select Stock Item</option>
														@foreach(Stock::all() as $stock)
														<option @if($stock->qty_in_stock==0){{"disabled"}} @endif value="{{$stock->id}}" data-src =" @if(is_null($stock->image)){{"assets/images/signature.jpg"}} @else {{$stock->image}} @endif "  @if(($stock->id==$stockrequest->stock->id)){{"selected"}} @else {{""}} @endif >{{ $stock->name }} @if($stock->qty_in_stock==0){{" (Out of Stock)"}} @endif</option>
														@endforeach
														
													</select>
													@error('stock_id')
														<p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
														@enderror
												</div>



												<div class="col-sm-6">
													<label for="qty_requested" class="form-label">Request Quantity<small style="color:#ff0000">*</small></label>
													<input type="number" class="form-control" required id="qty_requested"  name="qty_requested"  value="{{$stockrequest->qty_requested}}" placeholder="Quantity Requested">
													@error('qty_requested')
														<p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
														@enderror
												

														@if(isset($errorMessage))
															<div class="alert alert-danger">{{ $errorMessage }}</div>
														@endif

												</div>
												<input type="text" class="form-control" required id="qty_requested"  name="requester_id"  value="{{ Auth::user()->profileid}}" hidden>
											</div>
											<div class="row my-5">

												<div class="col-sm-6">
													<label for="recipient_id" class="form-label">Send To <small style="color:#ff0000">*</small></label>
													<select class="form-control" id="recipient_id" name="recipient_id">
														<option value="">Select Request Recipient</option>
														@foreach(User::all() as $user)
														<option  value="{{$user->profileid}}" @if($stockrequest->recipient_id==$user->profileid){{"selected"}}@endif>{{ $user->name }} </option>
														@endforeach
														
													</select>
													@error('receipient_id')
														<p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
														@enderror
												</div>
                                                @php
                                                 $copy  = explode(",",$stockrequest->copy_id);
                                                 @endphp
        
												<div class="col-sm-6">
													<label for="inputCategory" class="form-label">Copy(s)</label>
													<select class="form-control" id="copy_id" name="copy_id[]" multiple>
														<option value="">Select Request Copy(s)</option>
														@foreach(User::all() as $user)
														<option  value="{{$user->profileid}}" @if(in_array($user->profileid,$copy)){{"selected"}}@endif >{{ $user->name }} </option>
														@endforeach
														
													</select>
													@error('copy_id')
														<p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
														@enderror
												</div>



												
											</div><br />
											
											
										
											
											
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
	// Get the input field
		var stock_image = document.getElementById('stock_image');

		// Get the image element
		const stock_id = document.getElementById('stock_id');
		// Listen for changes to the input field
		stock_id.addEventListener('change', function() {
			 const selectedValue = stock_id.value;
            const selectedOption = stock_id.options[stock_id.selectedIndex];
            const imageSrc = selectedOption.dataset.src;

			// Update the src attribute of the image element
			if (selectedValue !== '') {
                    stock_image.src = imageSrc;
                    stock_image.alt = selectedValue;
                } else {
                    stock_image.src = 'assets/images/signature.jpg';
                    stock_image.alt = 'select Stock ';
                }
		});
	

$('#unit_price').on('input', function() {
	var amount = $('#qty_purchased').val();
	var unit_price =$('#unit_price').val();
	
	if(amount > 0 && unit_price > 0){
       $('#total_amount').val(amount * unit_price);
	   $('#total_amount2').val(amount * unit_price);
	}else {
		 $('#total_amount').val(0);
		  $('#total_amount2').val(0);
	}
			// Set the value of the second input field based on the value of the first using jQuery
			
		});
$('#qty_purchased').on('input', function() {
	var amount = $('#qty_purchased').val();
	var unit_price =$('#unit_price').val();
	
	if(amount > 0 && unit_price > 0){
       $('#total_amount').val(amount * unit_price);
	    $('#total_amount2').val(amount * unit_price);
	}else {
		 $('#total_amount').val(0);
		  $('#total_amount2').val(0);
	}
			// Set the value of the second input field based on the value of the first using jQuery
			
		});


//	import swal from 'sweetalert';
	//Adding bank into the system
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
  title: 'Are you sure you want to Edit Request?',
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
      'Editing!',
      'Request Editing  in progress.',
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