<x-layout>
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Stocks Requests</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><a href="/stocks"><i class="bx bx-user"></i></a>
								</li>
								<li class="breadcrumb-item " aria-current="page">Stock Request Records</li>
							</ol>
						</nav>
					</div>

				</div>
                

		<div class="card" style="padding: 20px;">
			<div class="card-body">
                <div class="row">
						 	<div class="col-sm-6">
								
			                	<h6 class="mb-0 text-uppercase">ALl Stock Request Table</h6>
							</div>
						 	<div class="col-sm-6">
								
							</div>
				</div>


			</div>
		</div>
                <br />


   
				<div class="card" style="padding: 20px;">
					<div class="card-body">
                        <div class="card-title">
							<x-flash-message />
							<h4 class="mb-0">All Stocks Request </h4>
						</div>
                        <hr/>
						<div class="table-responsive">


							<table id="example" class="table" style="width:100%">
								<thead>
									<tr>
										<th>s/n</th>
                                        <th>Image</th>
										<th>Stock Name</th>
										<th>Stock ID</th>
										<th>Category</th>
										<th>Requested By </th>
										<th>Requested Amount </th>
										<th>Number in Stock</th>
                                        
                                        <th>status</th>
                                      
									</tr>
								</thead>
								<tbody>
                                    @unless (count($stockrequests)==0)
                                        
                                            @foreach($stockrequests as $key => $request)
										 
                                            
                                            <tr>
                                                <td>{{ $key+1}}  </td>
                                                <td> 
													<!--
													<img src ="
													asset($request->stock->image) 
													
													
													"  width="50px;"/>
													-->
													@php
									$image = '';
									
									if($request && $request->stock){
										$image = $request->stock->image;
                                                                }
									@endphp
													 <img src ="{{asset($image) }}"  width="50px;"/> 
												</td>
													
                                                <td>
												@php
												$name = '';
												
												if($request && $request->stock){
													$name = $request->stock->name;
																			}
												@endphp
												
												  
														
													{{ $name}}
													
												</td>
                                                <td>
											  @php
												$stock_id = '';
												
												if($request && $request->stock){
													$stock_id = $request->stock->stock_id;
																			}
												@endphp							   		
														
														{{ $stock_id }}
													
													</td>
                                                <td>
													@php
												$cat_name = '';
												
												if($request && $request->stock && $request->stock->categories){
													$cat_name = $request->stock->name;
																			}
												@endphp
													
														{{$cat_name}}
													
													
												
												
												</td>
                                                <td>
												@php
												$requester_name = '';
												
												if($request && $request->requester ){
													$requester_name = $request->requester->name;
																			}
												@endphp
													
												{{ $requester->name }}
											</td>
                                                <td>{{ number_format($request->qty_requested) }}</td>
                                                <td>
														
												@php
												$stock_quantity = '';
												
												if($request && $request->stock ){
													$stock_quantity = $request->stock->qty_in_stock;
																			}
												@endphp

                                                  {{  number_format($stock_quantity) }}

                                              

													
													
													</td>
                                               
                                                <td>
                                                        <a href="/stockrequest{{$request->id}}">
                                                                @if($request->status =="pending")
                                                                <button type="button" class="btn btn-warning btn-sm">Pending</button>
                            
                                                                @elseif($request->status =="approved")
                                                                <button type="button" class="btn btn-success btn-sm"> Approved</button>

                                                                 @elseif($request->status =="disbursed")
                                                                <button type="button" class="btn btn-info btn-sm"> Disbursed</button>
                                                                @else
                                                                <button type="button" class="btn btn-danger btn-sm"> Rejected</button>
                                                                @endif
                                                        </a>
                                                    
                                                 </td>
                                              </tr>
                                          
                                            @endforeach
                                    @else
                                    <p>No Stock Request found</p>
                                    @endunless
								</tbody>
							</table>
                           


						</div>
                        
					</div>
				</div>
                


</x-layout>