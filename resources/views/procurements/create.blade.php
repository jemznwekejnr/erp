<x-layout>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Procurement</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0" style="background-color: transparent;">
								<li class="breadcrumb-item"><a href="/procurements"><i class="bx bx-user"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add New Procurement equest</li>
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
							<h5 class="mb-0">Procurement Request</h5>
                            <p>Request for, and view all requested procurements.</p>
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
					 <form class="row g-3" action="/procurementcreate" id="submitstaff" method="post"  enctype="multipart/form-data">
					 	@csrf

       
					 	
			<div class="col-sm-12">
					 	<div class="row">
						 	<div class="col-sm-4">
								<label for="item" class="form-label">Item Name<small style="color:#ff0000">*</small></label>
								<input type="text" class="form-control" id="item" name="item" placeholder="Item  Name"  value="{{old('item')}}"  required>
                                 @error('item')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
                            <div class="col-sm-4">
								<label for="quantity" class="form-label">Quantity<small style="color:#ff0000">*</small></label>
								<input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quntity"  value="{{old('quantity')}}"  required>
                                 @error('quantity')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
						 	<div class="col-sm-4">
								<label for="date" class="form-label">Date<small style="color:#ff0000">*</small></label>
                                	@php $today = date('Y-m-d') @endphp
								@php $date = strtotime($today.' -15 year') @endphp
								<input type="date" class="form-control" id="date" name="date"  placeholder="Choose date" value="{{old('date')}}"  required >
                                 @error('date')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
							<!--
                            <div class="col-sm-3">
								<label for="amount" class="form-label">Amount<small style="color:#ff0000">*</small></label>
								<input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount"  value="{{old('quantity')}}"  required>
                                 @error('amount')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
							-->
						</div><br />
                       <div class="row">
						 	<div class="col-sm-4">
								<label for="unit_price" class="form-label">Unit Price<small style="color:#ff0000">*</small></label>
								<input type="number" class="form-control" id="unit_price" name="unit_price" placeholder="Unit Price"  value="{{old('unit_price')}}"  required>
                                 @error('unit_price')
                                    <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
                            <div class="col-sm-4">
								<label for="total_price" class="form-label">Total Price<small style="color:#ff0000">*</small></label>
									<input type="number" class="form-control" id="total_price2" name="total_price2" placeholder="Unit Price"  value="{{old('total_price')}}" disabled required>
                           
								<input type="number" class="form-control" id="total_price" name="total_price" placeholder="Unit Price"  value="{{old('total_price')}}" hidden  required>
                                 @error('total_price')
                                    <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
						 	<div class="col-sm-4">
								<label for="date" class="form-label">Requested By<small style="color:#ff0000">*</small></label>
								<input type="text" class="form-control" id="dte" name="req" placeholder="{{Auth::user()->name}}"  value="" disabled>
                                <input type="text" class="form-control" id="requested_by" name="requested_by" placeholder=""  value="{{Auth::user()->profileid}}" hidden >
                                
							</div>
					</div>
                        <br />


						<div class="row">

                            <div class="col-sm-4">
								<label for="sent_to" class="form-label">Send To</label>
								<select class="form-control" id="sent_to" name="sent_to">
									<option value="">Select Receiver</option>
									@foreach($staffs as $staff)
									<option value="{{$staff->id}}">{{ $staff->surname }} {{$staff->firstname}}</option>
									@endforeach
                                    
								</select>
                                 @error('sent_to')
                                    <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>



						 	<div class="col-sm-4">
								<label for="qty_purchased" class="form-label">Add Attachment<small style="color:#ff0000">*</small></label>
								<input type="file" class="form-control"   name="files[]"  value="{{old('files')}}" placeholder="Add Attachment" multiple>
                                   @error('files.*')
                                    <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>

                             <div class="col-sm-4">
								
							</div>
						</div><br />
						
					<div class="row m-2">
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

$('#unit_price').on('input', function() {
				var amount = $('#quantity').val();
				var unit_price =$('#unit_price').val();
				
				if(amount > 0 && unit_price > 0){
				$('#total_price').val(amount * unit_price);
				$('#total_price2').val(amount * unit_price);
				}else {
					$('#total_price').val(0);
					$('#total_price2').val(0);
				}
						// Set the value of the second input field based on the value of the first using jQuery
			
	});
$('#quantity').on('input', function() {
	var amount = $('#quantity').val();
	var unit_price =$('#unit_price').val();
	
	if(amount > 0 && unit_price > 0){
       $('#total_price').val(amount * unit_price);
	    $('#total_price2').val(amount * unit_price);
	}else {
		 $('#total_price').val(0);
		  $('#total_price2').val(0);
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
			title: 'Are you sure you want to send Procurement Request?',
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
				'Sending Procurement Request',
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