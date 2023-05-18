<x-layout>

<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Budget</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0" style="background-color: transparent;">
								<li class="breadcrumb-item"><a href="/budgets"><i class="bx bx-copy"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page"> {{$budget->description}}  Request Page</li>
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
                                                <h4 class="mb-0">{{$budget->description}}  Request Details</h4>
                                                <p>View details of Budget request</p>
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
                        
                             <div class="row my-3">
                                       

                                    @if($budget->status=="pending" && $budget->requested_by == Auth::user()->profileid)
                                        <div class="col-lg-2">
                                            <form method="POST" action="/budget/{{$budget->id}}" name='delete'>

                                                @csrf
                                                @method('DELETE')
                                                <button  class="btn btn-danger" id="delete-budget" type="submit" data-src="delete">
                                                    Delete <i class='bx bxs-trash'></i> 
                                                </button>
                                                <img src="{{ asset('assets/images/processing.gif') }}" width="50px;" id="processing" class="processing" style="display: none;">
                                
                                            </form>
                                        
                                        </div>

                                    @endif
    

                                    <div class="col-lg-10 ">
                                        <div class="card">
                                            <div class="card-body">
                                                
                                                <div class="status mb-3">
                                                                    @php
                                                                        if($budget->status=="pending"){
                                                                            echo "<span class='badge bg-warning'>Request Pending Approval</span> ";
                                                                        }else if($budget->status=="approved"){
                                                                            echo "<span class='badge bg-success'>Request Approved</span> ";
                                                                        } elseif($budget->status=="disbursed") {
                                                                            echo "<span class='badge bg-info'>Request Disbursed</span> ";
                                                                
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
                                        <p>Budget Number:</p>
                                    </div>
                                    <div class="col-lg-10 ">
                                         
                                            <p><b>{{$budget->number}}</b><p>

                                           
                                        
                                    </div>
                        </div>
                             
                          
                             
                             <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Description:</p>
                                    </div>
                                    <div class="col-lg-10 ">
                                          <p><b>{{$budget->description}} </b></p>
                                    </div>
                            </div>
                             <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Amount</p>
                                    </div>
                                    <div class="col-lg-10 ">
                                           <p> <b>&#8358; {{number_format($budget->amount,2)}} </b></p>

                                    </div>
                            </div>
                           
                            
                            <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Requested By:</p>
                                    </div>
                                    <div class="col-lg-10">
                                            <p> <b> {{$budget->requestedBy->name}}</b></p>

                                    </div>
                            </div>

                            <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Requested At:</p>
                                    </div>
                                    <div class="col-lg-10">
                                            <p> <b> {{date('Y-m-d', strtotime($budget->date))}}</b></p>

                                    </div>
                            </div>
                         <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Sent To:</p>
                                    </div>
                                    <div class="col-lg-10">
                                            <p><b>  {{$budget->sentTo->name}}</b></p>

                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-lg-2">
                                        <p>Duration:</p>
                                    </div>
                                    <div class="col-lg-10">
                                        <p> 
                                        @php
                                            $date1 = "2007-03-24";
                                        $date2 = "2009-06-26";

                                        $diff = abs(strtotime($budget->end_date) - strtotime($budget->start_date));

                                        $years = floor($diff / (365*60*60*24));
                                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                                        printf("<b> %d months, %d days\n </b>", $months, $days);
                                        @endphp
                                          <b> -  {{date('Y-m-d', strtotime($budget->start_date))}} - {{date('Y-m-d', strtotime($budget->end_date))}}</b>
                                        
                                        </p>

                                    </div>
                            </div>
                           
                            <div class="row">
                                    <div class="col-lg-2">
                                        <p>Request Status:</p>
                                    </div>
                                    <div class="col-lg-10">
                                              @php
                                                                                        if($budget->status=="pending"){
                                                                                            echo "<span class='badge bg-warning'>Pending</span> ";
                                                                                        }elseif($budget->status=="rejected"){
                                                                                            echo "<span class='badge bg-danger'>Rejected</span> ";
                                                                                        }elseif($budget->status=="approved"){
                                                                                            echo "<span class='badge bg-success'>Approved</span> ";
                                                                                        }else{
                                                                                             echo "<span class='badge bg-success'>Disbursed</span> ";
                                                                                   
                                                                                        }
                                                                                        

                                                                                        @endphp

                                    </div>
                            </div>
                            @if(!is_null($budget->disbursed_date))
                                                <div class="row my-3">
                                                            <div class="col-lg-2">
                                                                <p>Date of Disbursment :</p>
                                                            </div>
                                                            <div class="col-lg-10">
                                                                    <p> <b> {{is_null($budget->disbursed_date)?"--": $budget->disbursed_date}} </b></p>

                                                            </div>
                                                </div>
                                                @endif
                                                @if(!is_null($budget->decline_date))
                                                <div class="row my-3">
                                                            <div class="col-lg-2">
                                                                <p>Date of Rejection :</p>
                                                            </div>
                                                            <div class="col-lg-10">
                                                                    <p> <b> {{is_null($budget->decline_date)?"--": $budget->decline_date}} </b></p>

                                                            </div>
                                                </div>
                                                @endif
                                              @if(!is_null($budget->approval_date))
                                                <div class="row my-3">
                                                            <div class="col-lg-2">
                                                                <p>Date of Approval :</p>
                                                            </div>
                                                            <div class="col-lg-10">
                                                                    <p> <b> {{is_null($budget->approval_date)?"--": $budget->approval_date}} </b></p>

                                                            </div>
                                                </div>
                                                @endif
                                                 @if(!is_null($budget->treated_by))
                                                <div class="row my-3">
                                                            <div class="col-lg-2">
                                                                <p>Treated By:</p>
                                                            </div>
                                                            <div class="col-lg-10">
                                                                    <p> <b> {{is_null($budget->treated_by)?"--": $budget->treatedBy->name}} </b></p>

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

$("form[name='delete']").submit(function(event) {
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
			title: 'Are you sure you want to Delete this  Budget Request?',
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
				'Deleting Budget Request',
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