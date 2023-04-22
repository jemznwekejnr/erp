<x-layout>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Stock Request</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0" style="background-color: transparent;">
								<li class="breadcrumb-item"><a href="/stocks"><i class="bx bx-copy"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">  {{ucfirst($stockrequest['stock']['name'])}}  Stock request Page</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
    


          <div class="row">
                <div class="col-lg-12 col-sm-12">
                   
                    <div class="card" style="padding-bottom: 30px;">
                          
                                <div class=" radius-10">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <div  class="m-3">
                                                <h4 class="mb-0">Request for {{ucfirst($stockrequest->stock->name)}} Stock Details</h4>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                           
                     </div>
                </div>
             
         </div>


        <div class="card" style="padding-bottom: 30px;">
          <div class="row">
                <div class="col-lg-12 col-sm-12" style="padding: 30px;">
                   
                         <div class="row my-3">
                            <div class="col-lg-2">
                                <form method="POST" action="/stockrequest/{{$stockrequest->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button  class="btn btn-danger" id="delete-stock" type="submit">
                                         Delete<i class='bx bxs-trash'></i> 
                                    </button>
                                    <img src="{{ asset('assets/images/processing.gif') }}" width="50px;" id="processing" class="processing" style="display: none;">
					
                                </form>
                              
                            </div>
                            <div class="col-lg-10 ">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <div class="status mb-3">
                                                               @php
                                                                if($stockrequest->status=="pending"){
                                                                    echo "<span class='badge bg-warning'>Request Pending Approval</span> ";
                                                                }else if($stockrequest->status=="approved"){
                                                                    echo "<span class='badge bg-success'>Request Approved</span> ";
                                                                } else {
                                                                     echo "<span class='badge bg-danger'>Request Rejected</span> ";
                                                           
                                                                }
                                                                

                                                                @endphp
                                       
                                        </div>
                                        
                                    </div>
                                  </div>

                            </div>

                         </div>

                         <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Item Image:</p>
                                    </div>
                                    <div class="col-lg-10 ">
                                         
                                            <img 
                                            src="@if(!is_null($stockrequest->stock->image)){{ asset($stockrequest->stock->image)}} @else {{ asset('assets/images/signature.jpg') }} @endif" 
                                            class="user-img" alt="user avatar">
                                           
                                        
                                    </div>
                        </div>
                             


                         <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Stock Name:</p>
                                    </div>
                                    <div class="col-lg-10 ">
                                          <p><b>{{ucfirst($stockrequest->stock->name)}} </b></p>
                                    </div>
                        </div>

                        <div class="row my-3">
                            <div class="col-lg-2">
                                <p>Category</p>
                            </div>
                            <div class="col-lg-10 ">
                                    <p><b>{{ucfirst($stockrequest->stock->categories->name)}}</b> </p>
                            </div>
                       </div>
                       <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Quantity Requested:</p>
                                    </div>
                                    <div class="col-lg-10">
                                          <p> <b> {{number_format($stockrequest->qty_requested)}}</b></p>
                                    </div>
                       </div>
                        <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Quantity in Stock:</p>
                                    </div>
                                    <div class="col-lg-10 ">
                                          <p> <b> {{number_format($stockrequest->stock->qty_in_stock)}}</b></p>
                                    </div>
                        </div>
                        
                       <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Date of Request:</p>
                                    </div>
                                    <div class="col-lg-10 ">
                                         <p> <b> {{ucfirst($stockrequest->request_date)}}</b></p>
                              
                                    </div>
                        </div>
                            @if($stockrequest->status=="approved"))
                    <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Date of Approval :</p>
                                    </div>
                                    <div class="col-lg-10">
                                            <p><b> 
                                          {{ is_null($stockrequest->approval_date)?"--":$stockrequest->approval_date}}</b></p>

                                    </div>
                    </div>
                        @endif
@if($stockrequest->status=="rejected")
                         <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Date of Rejection :</p>
                                    </div>
                                    <div class="col-lg-10">
                                            <p> <b> {{is_null($stockrequest->decline_date)?"--": $stockrequest->decline_date}} </b></p>

                                    </div>
                        </div>
                         @endif

                    @if($stockrequest->status=="pending")
               
                              <div class="row my-5">
                            <div class="col-lg-2">
                               
                                    
                               <p>Edit:</p>
                              
                            </div>
                            <div class="col-lg-10 ">
                                <a href="/mystockrequestedit{{$stockrequest->id}}">
                                <button  class="btn btn-warning" id="delete-task" >
                                         Edit<i class='bx bx-edit'></i>
                                    </button>
                                </a>
                                 
                            </div>
                            </div>
                   @endif
               
                        </div>
                
             
       
       
                              
       
                    </div>
 </div>
		
	</div>
</div>
<!--end page wrapper -->
				



</x-layout>


<script>


//	import swal from 'sweetalert';
	//Adding bank into the system
$('form').submit(function(event) {
    event.preventDefault(); // prevent the form from submitting
     $("#button").hide();
	$("#processing").show();
	
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-danger',
    cancelButton: 'btn btn-success'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure you want to Delete this Stock?',
  text: "You won't be able to revert this Action!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, Delete !',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
	 $(this).unbind('submit').submit();
    swalWithBootstrapButtons.fire(
      'Deleted!',
      'Stock Delete in process.',
      'success'
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