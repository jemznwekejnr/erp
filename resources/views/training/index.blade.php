<x-layout>
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Training</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><a href="/mytrainings"><i class="bx bx-user"></i></a>
								</li>
								<li class="breadcrumb-item " aria-current="page"> All Training Request Records</li>
							</ol>
						</nav>
					</div>

				</div>
				 <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
					<div class="col">
						<div class="card radius-10 border-primary border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h4 class="my-1 text-primary">{{ $total_request}}</h4>
										<p class="mb-0">Total training request</p>
										
									</div>
									<div class="text-primary ms-auto font-35">
										<i class='bx bx-git-pull-request'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col">
						<div class="card radius-10 border-success border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										
										<h4 class="my-1 text-success ">{{number_format($total_training_done)}}</h4>
										<p class="mb-0">Total training done</p>
									</div>
									<div class="text-success ms-auto font-35"><i class='bx bx-git-pull-request'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10  border-warning border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										
										<h4 class="text-warning my-1">{{number_format($staff_training_rate)}}</h4>
										<p class="mb-0">Training To-Do</p>
									</div>
									<div class="text-warning ms-auto font-35"><i class='bx bx-stats'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
	    	</div><!--end row-->

          
		<div class="card" style="padding: 20px;">
			<div class="card-body">
                <div class="row">
						 	<div class="col-sm-6">
								
			                	<h6 class="mb-0 text-uppercase">All Training Request Table</h6>
							</div>
						 	<div class="col-sm-6">
								<a href="/trainingcreate" style=" 
					position: relative;
					float: right;
					"><button class="btn btn-success"> + Add Training Request </button> </a>
												</div>
				</div>


			</div>
		</div>
                <br />


   
				<div class="card" style="padding: 20px;">
					<div class="card-body">
                        <div class="card-title">
							<x-flash-message />
							<h4 class="mb-0">All Training </h4>
						</div>
                        <hr/>
						<div class="table-responsive">


							<table id="example" class="table" style="width:100%">
								<thead>
									<tr>
										<th>s/n</th>
										<th>Description</th>
										<th>Type</th>
										<th>Duration(days)</th>
										<th>Start Date</th>
										<th>Mood </th>
										<th>Status</th>
                                       
                                      
									</tr>
								</thead>
								<tbody>
                                    @unless (count($trainings)==0)
                                        
                                            @foreach($trainings as $key => $training)
										  @php

											


											@endphp 
                                            
                                            <tr>
                                                <td>{{ $key+1}} </td>
                                                <td>{{ $training->description }}</td>
                                                <td>{{ $training->training_type }}</td>
                                                <td>{{ $training->duration }}</td>
                                                <td>{{ date('Y-m-d', strtotime($training->training_date ))}}</td>
                                                 <td>{{ $training->training_mode }}</td>
                                          
												
                                                <td>
                                                        <a href="/showtraining{{$training->id}}">
                                                                		
													  @if($training->status=="to-do")
                                                                <button type="button" class="btn btn-warning btn-sm">To-Do</button>
                            
                                                                @elseif($training->status=="approved")
                                                                <button type="button" class="btn btn-success btn-sm"> Approved</button>

                                                                @elseif($training->status=="rejected")
                                                                <button type="button" class="btn btn-danger btn-sm"> Rejected</button>

                                                                @elseif($training->status=="ongoing")
                                                                <button type="button" class="btn btn-info btn-sm"> Ongoing</button>
																@else
																  <button type="button" class="btn btn-danger btn-sm"> Pending</button>

                                                                @endif
                                                        </a>
                                                    
                                                 </td>
                                              </tr>
                                          
                                            @endforeach
                                    @else
                                    <p>No Training found</p>
                                    @endunless
								</tbody>
							</table>
                           


						</div>
                        
					</div>
				</div>
                


</x-layout>