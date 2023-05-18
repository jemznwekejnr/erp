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
								<li class="breadcrumb-item">
                                    <a href="/categories"><i class="bx bx-copy"></i></a>
                                    
								</li>
								<li class="breadcrumb-item active" aria-current="page"> {{$category->name}} </li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
    


          <div class="row">
              
             
         </div>


       <div class="card-body" style="padding-top: 40px;">
		<x-flash-message />
		
				  	<div class="form-body">
					 <form class="row g-3" action="/category/{{$category->id}} " id="submitstaff" method="post" name="edit-cat">
					 	@csrf
                        @method('PUT')
					 	<div class="col-sm-4">
					 	
					 	</div>
					 	<div class="col-sm-8">
					 	<div class="row">
							
						 	<div class="col-sm-6">
								<label for="name" class="form-label">( Edit )  Category Name<small style="color:#ff0000">*</small></label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Stock  Name"  value="{{$category->name}}"  required>
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
							</div>
						 	
						</div><br />
						</div>
					 </form>
					 </div>
				  </div>
		
	</div>
</div>
<!--end page wrapper -->
				



</x-layout>
<script>

//	import swal from 'sweetalert';
	//Adding bank into the system
$("form[name='edit-cat']").submit(function(event) {
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
			title: 'Are you sure you want to Edit this  Category?',
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
				'Editing Procurement Request',
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