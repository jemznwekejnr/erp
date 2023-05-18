<x-layout>
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Procurement</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><a href="/stocks"><i class="bx bx-user"></i></a>
								</li>
								<li class="breadcrumb-item " aria-current="page">Procurement Records</li>
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
										<p class="mb-0">Total request made</p>
										
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
										<h4 class="my-1 text-success">{{number_format($total_cost_incured, 2)}}</h4>
										<p class="mb-0">Total cost incurred</p>
										
									</div>
									<div class="text-success ms-auto font-35">&#8358;
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 border-warning border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										
										<h4 class="my-1 text-warning ">{{number_format($pending)}}</h4>
										<p class="mb-0">Pending Request</p>
									</div>
									<div class="text-warning ms-auto font-35"><i class='bx bx-git-pull-request'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10  border-success border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										
										<h4 class="text-success my-1">{{number_format($approved)}}</h4>
										<p class="mb-0">Approved Request</p>
									</div>
									<div class="text-success ms-auto font-35"><i class='bx bx-git-pull-request'></i>
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
												
												<h6 class="mb-0 text-uppercase">My Procurement Request List </h6>
											</div>
											<div class="col-sm-6">
												<a href="/procurementcreate"><button class="btn btn-success"> + Add New Rquest </button> </a>
											</div>
								</div>
							</div>
				</div>
                <br/>

				<div class="card" style="padding: 20px;">
					<div class="card-body">
                        <div class="card-title">
							<x-flash-message />
							<h4 class="mb-0">My Procurements </h4>
						</div>
                        <hr/>
						<hr/>
						<div class="table-responsive">


							<table id="example" class="table" style="width:100%">
								<thead>
									<tr>
										<th>s/n</th>
                                        <th>Name</th>
										<th>Qty</th>
										<th>Total Price</th>
										<th>Requested By</th>
										<th>Sent to</th>
										<th>Date </th>
										<th>Status</th>
                                      
                                        
									</tr>
								</thead>
								<tbody>
                                @unless (count($procurements)==0)
                                        
                                            @foreach($procurements as $key => $procurement)
							             @php
                                            if($procurement->requested_by != Auth::user()->profileid){
                                                                                        continue;
                                                                                    }
											// $startDate = \Carbon\Carbon::parse($project->start_date);
                                          
										 	// $endDate = \Carbon\Carbon::parse($project->end_date);

											// $numberOfDays = $endDate->diffInDays($startDate);
                         


											@endphp 
                                            
                                            
                                            <tr>
                                                <td><a href="/procurement{{$procurement->id}}">{{ $key+1}}  </a></td>
                                                <td>{{ $procurement->item }}</td>
                                                <td>{{number_format( $procurement->quantity ,0)}}</td>
                                                <td><b>&#8358; {{number_format($procurement->total_price,2)}} </b></td>
                                                <td>{{ $procurement->requestedBy->name }}</td>
                                                <td>{{ $procurement->sentTo->name }}</td>
                                                <td>{{ $procurement->date }}</td>
                                               
												<td><a href="/procurement{{$procurement->id}}">
													
													  @if($procurement->status=="pending")
                                                                <button type="button" class="btn btn-warning btn-sm">pending</button>
                            
                                                                @elseif($procurement->status=="approved")
                                                                <button type="button" class="btn btn-success btn-sm"> Approved</button>

                                                                @elseif($procurement->status=="rejected")
                                                                <button type="button" class="btn btn-danger btn-sm"> Rejected</button>

                                                                @elseif($procurement->status=="dispersed")
                                                                <button type="button" class="btn btn-info btn-sm"> Dispersed</button>
																@else
																  <button type="button" class="btn btn-danger btn-sm"> Rejected</button>

                                                                @endif
												</td>
                                                 
                                              
                                              </tr>
                                          
                                            @endforeach
                                    @else
                                    <p>No Procurement found</p>
                                    @endunless
								</tbody>
							</table>
                           


						</div>
                        
					</div>
				</div>
                
            

   



				
				
                <div class=" mt-6 p-4">
                          
                </div>


</x-layout>