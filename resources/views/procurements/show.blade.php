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
								<li class="breadcrumb-item"><a href="/procurements"><i class="bx bx-copy"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page"> {{$procurement->item}}  Request Page</li>
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
                                            <div>
                                                <h4 class="mb-0">{{$procurement->item}}  Request Details</h4>
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
                                <x-flash-message />
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <form method="POST" action="/procurement/{{$procurement->id}}" name="delete-procurement">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button  class="btn btn-danger" id="delete-task">
                                                        Delete<i class='bx bxs-trash'></i> 
                                                    </button>
                                                </form>
                                            
                                            </div>
                                            <div class="col-lg-10 ">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                
                                                                <div class="status mb-3">
                                                                                    @php
                                                                                        if($procurement->status=="pending"){
                                                                                            echo "<span class='badge bg-warning'>Pending</span> ";
                                                                                        }elseif($procurement->status=="rejected"){
                                                                                            echo "<span class='badge bg-danger'>Rejected</span> ";
                                                                                        }elseif($procurement->status=="approved"){
                                                                                            echo "<span class='badge bg-success'>Approved</span> ";
                                                                                        }else{
                                                                                             echo "<span class='badge bg-success'>Disbursed</span> ";
                                                                                   
                                                                                        }
                                                                                        

                                                                                        @endphp
                                                            
                                                                </div>
                                                                
                                                            </div>
                                                        </div>

                                                </div>


                                            </div>
                                            <div class="row my-5">
                                                    <div class="col-lg-2">
                                                        <p>Item Image:</p>
                                                    </div>
                                                    <div class="col-lg-10 ">
                                                    
                                            
                                                        
                                                        
                                                        
                                                                    
                                                            <img 
                                                            src="@if(!is_null($procurement->attachment)){{ asset($procurement->attachment)}} @else {{ asset('assets/images/default-avatar.png') }} @endif" 
                                                            class="user-img" alt="user avatar">
                                                        
                                                        
                                                    </div>
                                            </div>
                                            
                                            <div class="row">
                                                    <div class="col-lg-2">
                                                        <p>Request Item Name:</p>
                                                    </div>
                                                    <div class="col-lg-10 ">
                                                        <p>{{$procurement->item}} </p>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-2">
                                                        <p>Quantity</p>
                                                    </div>
                                                    <div class="col-lg-10 ">
                                                        <p><b>{{number_format($procurement->quantity)}}</b> </p>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-2">
                                                        <p>Unit Price:</p>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <p><b> &#8358;
                                                           {{number_format( $procurement->unit_price,2)}}</b></p>
                                                    </div>
                                            </div>
                                              <div class="row">
                                                    <div class="col-lg-2">
                                                        <p>Total Amount price:</p>
                                                    </div>
                                                    <div class="col-lg-10">
                                                            <p> <b> &#8358;
                                                           {{number_format( $procurement->total_price,2)}}</b></p>

                                                    </div>
                                        </div>
                                            <div class="row">
                                                    <div class="col-lg-2">
                                                        <p>Request  Date:</p>
                                                    </div>
                                                    <div class="col-lg-10 ">
                                                        <p>  {{$procurement->created_at}}</p>
                                                    </div>
                                            </div>
                                             
                                                @if(!is_null($procurement->disbursed_date))
                                                <div class="row my-3">
                                                            <div class="col-lg-2">
                                                                <p>Date of Disbursment :</p>
                                                            </div>
                                                            <div class="col-lg-10">
                                                                    <p> <b> {{is_null($procurement->disbursed_date)?"--": $procurement->disbursed_date}} </b></p>

                                                            </div>
                                                </div>
                                                @endif
                                                @if(!is_null($procurement->decline_date))
                                                <div class="row my-3">
                                                            <div class="col-lg-2">
                                                                <p>Date of Rejection :</p>
                                                            </div>
                                                            <div class="col-lg-10">
                                                                    <p> <b> {{is_null($procurement->decline_date)?"--": $procurement->decline_date}} </b></p>

                                                            </div>
                                                </div>
                                                @endif
                                              @if(!is_null($procurement->approval_date))
                                                <div class="row my-3">
                                                            <div class="col-lg-2">
                                                                <p>Date of Approval :</p>
                                                            </div>
                                                            <div class="col-lg-10">
                                                                    <p> <b> {{is_null($procurement->approval_date)?"--": $procurement->approval_date}} </b></p>

                                                            </div>
                                                </div>
                                                @endif
                                                 @if(!is_null($procurement->treated_by))
                                                <div class="row my-3">
                                                            <div class="col-lg-2">
                                                                <p>Treated By:</p>
                                                            </div>
                                                            <div class="col-lg-10">
                                                                    <p> <b> {{is_null($procurement->treated_by)?"--": $procurement->treatedBy->name}} </b></p>

                                                            </div>
                                                </div>
                                                @endif
                                        
                                            
                                            <div class="row">
                                                    <div class="col-lg-2">
                                                        <p>Requested By:</p>
                                                    </div>
                                                    <div class="col-lg-10">
                                                            <p>  {{$procurement->requestedBy->name}}</p>

                                                    </div>
                                            </div>
                                             <div class="row">
                                                    <div class="col-lg-2">
                                                        <p>Sent To:</p>
                                                    </div>
                                                    <div class="col-lg-10">
                                                            <p>  {{$procurement->sentTo->name}}</p>

                                                    </div>
                                            </div>
                                      
                                       <div class="row">
                                                    <div class="col-lg-2">
                                                        <p>Request Status:</p>
                                                    </div>
                                                    <div class="col-lg-10">
                                                               @php
                                                                                        if($procurement->status=="pending"){
                                                                                            echo "<span class='badge bg-warning'>Pending</span> ";
                                                                                        }elseif($procurement->status=="rejected"){
                                                                                            echo "<span class='badge bg-danger'>Rejected</span> ";
                                                                                        }elseif($procurement->status=="approved"){
                                                                                            echo "<span class='badge bg-success'>Approved</span> ";
                                                                                        }else{
                                                                                             echo "<span class='badge bg-success'>Disbursed</span> ";
                                                                                   
                                                                                        }
                                                                                        

                                                                                        @endphp

                                                    </div>
                                        </div>
                                        

                                    
                            
                                            <div class="row">
                                                
                                            
                                                    <div class="col-lg-2">
                                                    
                                                            
                                                    <p>Attachment? </p>
                                                    
                                                    </div>
                                                    <div class="col-lg-10 ">
                                                        @if(!is_null($procurement->attachment)){{ "Yes"}} @else {{ "No" }} @endif
                                            
                                                        
                                                    </div>
                                            </div>
                                            @if(!is_null($procurement->attachment))

                                         <div class="row">
                                                
                                            
                                                    <div class="col-lg-2">
                                                    
                                                            
                                                    <p>Download Attachment </p>
                                                    
                                                    </div>
                                                    <div class="col-lg-10 ">
                                                        <a href="{{asset($procurement->attachment)}}">
                                                          <button disabled="disabled"><i class='bx bxs-cloud-download'></i></button> 
                                                        </a>
                                            
                                                        
                                                    </div>
                                            </div>

                                            @endif
                                            <div class="row">
                                                <div class="col-lg-2">
                                            
                                                    
                                            <p>Edit:</p>
                                            
                                            </div>
                                            <div class="col-lg-10 ">
                                                <a href="/procurementedit{{$procurement->id}}">
                                                <button  class="btn btn-warning" id="delete-task" >
                                                        Edit<i class='bx bx-edit'></i>
                                                    </button>
                                                </a>
                                                
                                            </div>
                                            </div>
                    
                            
                                        </div>
                                
                            
                    
                    
                                            
                    
                   </div>
                    

               

            
                     <div class="row my-3">
                                                
                                                    <div class="col-lg-12 ">
                                                            <div class="card radius-10">
                                                                <div class="card-header">
                                                                    <div class="d-flex align-items-center">
                                                                        <div>
                                                                            <h5 class="mb-0">Treat {{$procurement->item}} Procurement Request</h5>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="card-body" style="padding-top: 40px;">
                                                                    <x-flash-message />
                                                                    <div class="form-body">
                                                                            <form class="row g-3" action="/procurement{{$procurement->id}}" id="submitstock" method="post" name="treat">
                                                                                @csrf
                                                                                
                                                                                
                                                                        
                                                                                <div class="row my-2">

                                                                                    <div class="col-sm-6">
                                                                                    
                                                                                        <h3 class="form-control"> {{ucfirst($procurement->item)}}  qty({{$procurement->quantity}})</h3>
                                                                                        <input type="text" class="form-control" required id="treated_by"  name="treated_by"  value="{{ Auth::user()->profileid}}" hidden>
                                                                                    </div>
                                                                                    
                                                                                    <div class="col-sm-6">
                                                                                        <label for="status" class="form-label">Approve Or Reject Request</label>
                                                                                        <select class="form-control" id="status" name="status" >
                                                                                            <option value="">Select Action</option>
                                                                                            
                                                                                            <option  value="approve" > Approve Request </option>
                                                                                            <option  value="reject" > Reject Request </option>
                                                                                            
                                                                                        </select>
                                                                                        @error('status')
                                                                                            <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                                                                            @enderror
                                                                                    </div>

                                                                                    
                                                                                </div><br />
                                                                                
                                                                                
                                                                            
                                                                                
                                                                                
                                                                                <div class="row">
                                                                                <div class="col-sm-6">
                                                                                        <label for="treat_comment"> Comment</label>
                                                                                        <textarea class="form-control" id="treat_comment" name= "treat_comment" rows="3"></textarea>

                                                                                                                                        
                                                                                    </div>
                                                                                    
                                                                                
                                                                                    <div class="col-sm-6 text-right float-right">
                                                                                    </div>
                                                                                </div><br />
                                                                        <div class="row my-2">
                                                                                <div class="col-sm-6">
                                                                                    
                                                                                                                                        
                                                                                    </div>
                                                                                    
                                                                                
                                                                                    <div class="col-sm-6 text-right float-right">
                                                                                        <button class="btn btn-info" type="submit" id="button">Submit</button>
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
 </div>
<!-- end page wrapper -->
				



</x-layout>

<script>

//	import swal from 'sweetalert';
	//Adding bank into the system
$("form[name='delete-procurement']").submit(function(event) {
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
			title: 'Are you sure you want to Delete  Procurement Request?',
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
				'Deleting Procurement Request',
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


$("form[name='treat']").submit(function(event) {
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
			title: 'Are you sure you want to Treat this  Procurement Request?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, Treat !',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
			}).then((result) => {
			if (result.isConfirmed) {
				$(this).unbind('submit').submit();
				swalWithBootstrapButtons.fire(
				'Deleting Procurement Request',
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