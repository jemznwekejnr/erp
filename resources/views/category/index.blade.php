<x-layout>
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Categories</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item " aria-current="page">Category Records</li>
							</ol>
						</nav>
					</div>
					<!--<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>-->
				</div>
            

				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">ALl Categories Table</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
								<x-flash-message />
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>s/n</th>
                                        <th>Category Name</th>
									
                                        <th>action</th>
									</tr>
								</thead>
								<tbody>
                                    @unless (count($categories)==0)
                                        
                                            @foreach($categories as $key => $category)
										  @php
											// $startDate = \Carbon\Carbon::parse($project->start_date);
											// $endDate = \Carbon\Carbon::parse($project->end_date);

											// $numberOfDays = $endDate->diffInDays($startDate);
                         


											@endphp 
                                            
                                            <tr>
                                                <td><a href="/category/{{$category->id}}">{{ $key+1}}  </a></td>
                                                <td>{{ $category->name }}</td>
                                                
                                                <td>
                                                    <form class="inline" method="POST" action="/category/{{$category->id}}" name="delete-cat">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit">
                                                           <i class='bx bxs-trash' style="color:red"></i> 
                                                        </button>
                                                     </form>
                                                    
                                                   
                                                     
                                                      
                                                         
                                                          <a  href="/category/{{$category->id}}">
                                                            <button>
                                                                  <i class='bx bxs-edit'  style="color:green"></i>
                                                  
                                                            </button>
                                                                      </a>
                                                 
                                                   
                                                     </td>
                                                 </tr>
                                          
                                            @endforeach
                                    @else
                                    <p>No Category found</p>
                                    @endunless
								</tbody>
							</table>
                           
						</div>
                        
					</div>
				</div>
                <div class=" mt-6 p-4">
                          
                </div>


</x-layout>
<script>

//	import swal from 'sweetalert';
	//Adding bank into the system
$("form[name='delete-cat']").submit(function(event) {
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
			title: 'Are you sure you want to Delete this  Category?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, Delete !',
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