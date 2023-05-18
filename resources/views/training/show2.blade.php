<x-layout>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Trainng</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0" style="background-color: transparent;">
								<li class="breadcrumb-item"><a href="/trainings"><i class="bx bx-copy"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page"> {{$training->description}}  Request Page</li>
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
                                                <h4 class="mb-0">{{$training->description}}  Request Details</h4>
                                                <p>View details of Training request</p>
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
                                       

                     
    

                                    <div class="col-lg-10 ">
                                        <div class="card">
                                            <div class="card-body">
                                                
                                                <div class="status mb-3">
                                                    
                                                                @php
                                                                
                                                                    if($training->status=="to-do"){
                                                                            echo "<span class='badge bg-warning'>ToDo</span> ";
                                                                        }else if($training->status=="rejected"){
                                                                            echo "<span class='badge bg-danger'>Rejected</span> ";
                                                                        }else if ($training->status=="approved") {
                                                                            echo "<span class='badge bg-success'>Approved</span> ";
                                                                        }
                                                              
                                                                @endphp
                                                                
                                                                
                                    
                                                </div>
                                            
                                            </div>
                                        </div>

                                    </div>

                           </div>
                           <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Training Description:</p>
                                    </div>
                                    <div class="col-lg-10 ">
                                         
                                            <p><b>{{$training->description}}</b><p>

                                           
                                        
                                    </div>
                        </div>
                             
                          
                             
                            
                        
                              <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Training Type</p>
                                    </div>
                                    <div class="col-lg-10 ">
                                           <p> <b> {{$training->training_type}} </b></p>

                                    </div>
                            </div>
                            <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Training Date:</p>
                                    </div>
                                    <div class="col-lg-10">
                                            <p> <b> {{date('Y-m-d', strtotime($training->training_date))}}</b></p>

                                    </div>
                            </div>
                            <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Training Duration</p>
                                    </div>
                                    <div class="col-lg-10 ">
                                           <p> <b> {{number_format($training->duration)}} </b></p>

                                    </div>
                            </div>
                           
                           
                            
                           
                            <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Training Mode:</p>
                                    </div>
                                    <div class="col-lg-10">
                                            <p> <b> {{$training->training_mode}}</b></p>

                                    </div>
                            </div>
                             <div class="row my-3">
                                    <div class="col-lg-2">
                                      <p> <b> Trainee(s):</b></p>
                                    </div>
                             </div>
                             <div class="row my-3">
                                   
                                        @php 
                                        $trainees =  explode(',', $training->trainees);
                                    
                                         
                                        @endphp
                                        
                                                    @foreach($trainees as $assign)
                                                  
                                             <div class="col-md-2 ">
                                            <img 
                                            src="@if(!is_null(DB::table('profile')->where('id', $assign)->pluck('image')[0])){{ DB::table('profile')->where('id', $assign)->pluck('image')[0] }} @else {{ asset('assets/images/default-avatar.png') }} @endif" 
                                            class="user-img" alt="user avatar">
                                            <p>{{DB::table('profile')->where('id', $assign)->pluck('surname')[0]}} </p>
                                             </div>
                                            @endforeach
                                   
                            </div>
                             <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Requested By:</p>
                                    </div>
                                    <div class="col-lg-10">
                                            <p> <b> {{$training->requestedBy->name}}</b></p>

                                    </div>
                            </div>

                        @if($training->status=="to-do")
                            
                           
                            <div class="row">
                                    <div class="col-lg-2">
                                        <p>Request Status:</p>
                                    </div>
                                    <div class="col-lg-10">
                                             <span class='badge bg-warning'>To-Do</span> 
                                               
                                    </div>
                            </div>

                            @endif
                         
                                                @if(!is_null($training->decline_date))
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <p>Request Status:</p>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <span class='badge bg-danger'>Rejected</span> 
                                                    </div>
                                              </div>
                                                <div class="row my-3">
                                                            <div class="col-lg-2">
                                                                <p>Date of Rejection :</p>
                                                            </div>
                                                            <div class="col-lg-10">
                                                                    <p> <b> {{is_null($training->decline_date)?"--": $training->decline_date}} </b></p>

                                                            </div>
                                                </div>
                                                @endif
                                              @if($training->status=="approved" &&  date('Y-m-d') < date('Y-m-d', strtotime($training->training_date)) )
                                              <div class="row">
                                                    <div class="col-lg-2">
                                                        <p>Request Status:</p>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <span class='badge bg-success'>Approved</span> 
                                                    </div>
                                              </div>
                                                <div class="row my-3">
                                                            <div class="col-lg-2">
                                                                <p>Date of Approval :</p>
                                                            </div>
                                                            <div class="col-lg-10">
                                                                    <p> <b> {{is_null($training->approval_date)?"--": $training->approval_date}} </b></p>

                                                            </div>
          
                                                </div>
                                                @endif
                                                 @if($training->status == "approved" && date('Y-m-d') >= date('Y-m-d', strtotime($training->training_date)) )
                                                <div class="row my-3">
                                                            <div class="col-lg-2">
                                                                <p>Status</p>

                                                            </div>
                                                            <div class="col-lg-10">
                                                                    <p> <b> <span class='badge bg-success'>Ongoing</span> </b></p>

                                                            </div>
                                                </div>
                                                @endif
                                                 
                                        

                    
                    
               
                        </div>
                
             
       
       
                              
       
                    </div>
       </div>


          @if($training->status != "approved" || date('Y-m-d') < date('Y-m-d', strtotime($training->training_date)) )
                     <div class="row my-3">
                                                
                                                    <div class="col-lg-12 ">
                                                            <div class="card radius-10">
                                                                <div class="card-header">
                                                                    <div class="d-flex align-items-center">
                                                                        <div>
                                                                            <h5 class="mb-0">Treat {{$training->description}} Training Request</h5>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="card-body" style="padding-top: 40px;">
                                                              
                                                                    <div class="form-body">
                                                                            <form class="row g-3" action="/treattraining{{$training->id}}" id="treatbudget" method="post" name="treat">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                
                                                                        
                                                                                <div class="row my-2">

                                                                                    <div class="col-sm-6">
                                                                                    
                                                                                        <h3 class="form-control"> {{ucfirst($training->description)}}  Training</h3>
                                                                                        <input type="text" class="form-control" required id="treated_by"  name="treated_by"  value="{{ Auth::user()->profileid}}" hidden>
                                                                                    </div>
                                                                                    
                                                                                    <div class="col-sm-6">
                                                                                        <label for="status" class="form-label">Approve Or Reject Request</label>
                                                                                        <select class="form-control" id="status" name="status" >
                                                                                            <option value="">Select Action</option>
                                                                                            
                                                                                            <option  value="approved" > Approve Request </option>
                                                                                            <option  value="rejected" > Reject Request </option>
                                                                                            
                                                                                        </select>
                                                                                        @error('status')
                                                                                            <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                                                                            @enderror
                                                                                    </div>

                                                                                    
                                                                                </div><br />
                                                                                
                                                                                
                                                                            
                                                                                
                                                                                
                                                                                <div class="row">
                                                                                <div class="col-sm-6">
                                                                                        <label for="treat_comment"> Comment</label>
                                                                                        <textarea class="form-control" id="comment" name= "treat_comment" rows="3"></textarea>

                                                                                           @error('treat_comment')
                                                                                            <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                                                                            @enderror                                             
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
                        
          @endif
		
	
     
		
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
			title: 'Are you sure you want to Delete this  Training Request?',
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
				'Deleting Training Request',
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
			title: 'Are you sure you want to Treat this  Training Request?',
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
				'Treating Training Request',
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