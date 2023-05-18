<x-layout>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Category</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0" style="background-color: transparent;">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add New Category</li>
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
							<h5 class="mb-0">Create Category</h5>
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
					 <form class="row g-3" action="/category" id="submitstaff" method="post">
					 	@csrf
					 	<div class="col-sm-4">
					 	
					 	</div>
					 	<div class="col-sm-8">
					 	<div class="row">
						 	<div class="col-sm-6">
								<label for="name" class="form-label">Category Name<small style="color:#ff0000">*</small></label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Stock  Name"  value="{{old('name')}}"  required>
                                 @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
						 	<div class="col-sm-6">
								
							</div>
						</div>
                        <br/>
						
                     
						<div class="row">
						 	<div class="col-sm-6">

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
			title: 'Are you sure you want to create a New Category?',
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
				'creating  Category',
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