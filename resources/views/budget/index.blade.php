<x-layout>
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Budget</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><a href="/budget"><i class="bx bx-user"></i></a>
								</li>
								<li class="breadcrumb-item " aria-current="page">Budget Records</li>
							</ol>
						</nav>
					</div>

				</div>
				
          
		<div class="card" style="padding: 20px;">
			<div class="card-body">
                <div class="row">
						 	<div class="col-sm-6">
								
			                	<h6 class="mb-0 text-uppercase">ALl Budget Table</h6>
							</div>
						 	<div class="col-sm-6">
								<a href="/budgetcreate" style=" 
					position: relative;
					float: right;
					"><button class="btn btn-success"> + Add Budget </button> </a>
												</div>
				</div>


			</div>
		</div>
                <br />


   
				<div class="card" style="padding: 20px;">
					<div class="card-body">
                        <div class="card-title">
							<x-flash-message />
							<h4 class="mb-0">All Budget </h4>
						</div>
                        <hr/>
						<div class="table-responsive">


							<table id="example" class="table" style="width:100%">
								<thead>
									<tr>
										<th>s/n</th>
                                        <th>Number</th>
										<th>Description</th>
										<th>Amount</th>
										<th>Actual Amount</th>
										<th>Start Date</th>
										<th>End Date </th>
										<th>Status</th>
                                       
                                      
									</tr>
								</thead>
								<tbody>
                                    @unless (count($budgets)==0)
                                        
                                            @foreach($budgets as $key => $budget)
										  @php

											// $startDate = \Carbon\Carbon::parse($project->start_date);
                                          
										 	// $endDate = \Carbon\Carbon::parse($project->end_date);

											// $numberOfDays = $endDate->diffInDays($startDate);
                         


											@endphp 
                                            
                                            <tr>
                                                <td>{{ $key+1}} </td>
                                                <td> {{ $budget->number }} </td>
                                                <td>{{ $budget->description }}</td>
                                                <td><b>&#8358; {{number_format($budget->amount) }}</td>
												
                                                <td><b>&#8358; {{number_format($budget->actual_amount) }}</td>
                                                <td>{{ date('Y-m-d', strtotime($budget->start_date ))}}</td>
                                                <td>{{ date('Y-m-d', strtotime($budget->end_date ))}}</td>
                                                <td>
                                                        <a href="/showbudget{{$budget->id}}">
                                                                		
													  @if($budget->status=="pending")
                                                                <button type="button" class="btn btn-warning btn-sm">pending</button>
                            
                                                                @elseif($budget->status=="approved")
                                                                <button type="button" class="btn btn-success btn-sm"> Approved</button>

                                                                @elseif($budget->status=="rejected")
                                                                <button type="button" class="btn btn-danger btn-sm"> Rejected</button>

                                                                @elseif($budget->status=="dispersed")
                                                                <button type="button" class="btn btn-info btn-sm"> Dispersed</button>
																@else
																  <button type="button" class="btn btn-danger btn-sm"> Pending</button>

                                                                @endif
                                                        </a>
                                                    
                                                 </td>
                                              </tr>
                                          
                                            @endforeach
                                    @else
                                    <p>No Budget found</p>
                                    @endunless
								</tbody>
							</table>
                           


						</div>
                        
					</div>
				</div>
                


</x-layout>