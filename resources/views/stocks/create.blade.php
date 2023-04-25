<?php

use App\Models\Category;

?>
<x-layout>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Stock</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0" style="background-color: transparent;">
								<li class="breadcrumb-item"><a href="/stocks"><i class="bx bx-user"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add New Stock</li>
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
							<h5 class="mb-0">Stock Details</h5>
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
					 <form class="row g-3" action="/stocks" id="submitstock" method="post" enctype="multipart/form-data">
					 	@csrf
					 	<div class="col-sm-4">
					 	<center>



					 		<!--image upload starts here--->
                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                            <div class="fileinput-new  avatar border-gray">
                                            <img src="{{ asset('assets/images/signature.jpg') }}" width="250px" alt="..." id="stock_image">
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



                            <input type="file" name="image"  id="image" value = "{{old('image')}}"/>


					 		
						</center>
					 	</div>
					 	<div class="col-sm-8">
					 	<div class="row">
						 	<div class="col-sm-6">
								<label for="inputFirstName" class="form-label">Stock Name<small style="color:#ff0000">*</small></label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Stock  Name"  value="{{old('name')}}"  required>
                                 @error('name')
                                    <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
						 	<div class="col-sm-6">
								<label for="inputFirstName" class="form-label">Stock ID<small style="color:#ff0000">*</small></label>
								<input type="text" class="form-control" id="stock_id" name="stock_id" placeholder="Stock ID"  value="{{old('stock_id')}}" required>
                                 @error('stock_id')
                                    <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
						</div><br />
						<div class="row">

                            <div class="col-sm-6">
								<label for="inputCategory" class="form-label">Categories</label>
								<select class="form-control" id="category" name="cat_id">
									<option value="">Select Category</option>
									@foreach(Category::all() as $category)
									<option value="{{$category->id}}">{{ $category->name }}</option>
									@endforeach
                                    
								</select>
								 @error('cat_id')
                                    <p class="text-red-500  text-danger text-xs mt-1">Please select a Category</p>
                                    @enderror
							</div>



						 	<div class="col-sm-6">
								<label for="qty_purchased" class="form-label">Quantity Purchased<small style="color:#ff0000">*</small></label>
								<input type="number" class="form-control" required id="qty_purchased"  name="qty_purchased"  value="{{old('qty_purchased')}}" placeholder="Quantity Purchased">
                                   @error('qty_purchased')
                                    <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
						</div><br />
						<div class="row">
						 	<div class="col-sm-6">
								<label for="inputFirstName" class="form-label">Unit Price<small style="color:#ff0000">*</small></label>
								<input type="number" class="form-control" id="unit_price" required name="unit_price" placeholder="Unit Price" value="{{old('unit_price')}}">
                                 @error('qty_purchased')
                                    <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
                            <div class="col-sm-6">
								<label for="inputTotalamount" class="form-label">Total Amount <small style="color:#ff0000">*</small></label>
								<input type="number" class="form-control" id="total_amount2" required name="total_amount2" placeholder="Total Amount" value="{{old('total_amount')}}"  disabled  >
                             
								<input type="number" class="form-control" id="total_amount" required name="total_amount" placeholder="Total Amount" value="{{old('total_amount')}}"  hidden  >
                                 @error('total_amount')
                                    <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
						 	
						</div>
						<br />
					
						
                        <div class="row">
						 	<div class="col-sm-6">
								<label for="inputSupplier" class="form-label">Supplier<small style="color:#ff0000">*</small></label>
								<input type="text"  class="form-control" id="supplier" name="supplier" required placeholder="Supplier" value="{{old('supplier')}}">
								 @error('supplier')
                                    <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
						 	
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
	// Get the input field
		var image = document.getElementById('image');

		// Get the image element
		var stock_image = document.getElementById('stock_image');
		// Listen for changes to the input field
		image.addEventListener('change', function() {
			// Get the selected file
			var file = image.files[0];

			// Create a URL for the selected file
			var url = URL.createObjectURL(file);

			// Update the src attribute of the image element
			stock_image.src = url;
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
			title: 'Are you sure you want to create Stock?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, Create !',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
			}).then((result) => {
			if (result.isConfirmed) {
				$(this).unbind('submit').submit();
				swalWithBootstrapButtons.fire(
				'Creating Stock!',
				'Stock Creation in process.',
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