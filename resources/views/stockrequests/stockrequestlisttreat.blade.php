<x-layout>
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Stock Requests Awaiting Action</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><a href="/stockrequestlisttreat"><i class="bx bx-user"></i></a>
								</li>
								<li class="breadcrumb-item " aria-current="page">My Stock Request Awaiting Action Records</li>
							</ol>
						</nav>
					</div>

	            </div>
                

                    <div class="card" style="padding: 20px;">
                        <div class="card-body">
                            <div class="row">
                                        <div class="col-sm-6">
                                            
                                            <h6 class="mb-0 text-uppercase">My Stock Request Awaiting Action List </h6>
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
                        @php


                             $mystockrequests = $stockrequests
                            @endphp
                            <div class="row">
                                             
                                    <div class="col-lg-6 col-sm-12">
                                        <h1 class="text-warning">Pending</h1>
                                        <div class="card" style="padding-bottom: 30px;">
                                            
                                                    <div class=" radius-10">
                                                        <div class="card-header">
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <h4 class="mb-0 text-warning">Pending</h4>
                                                                </div>

                                                            </div>
                                                        </div>



                                                        <div class="card-body" style="padding-top: 30px;">
                                                            @unless (count($mystockrequests)==0)
                                                            <div class="table-responsive">


                                                                <table id="pending" class="table" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            
                                                                        <th>Stock Name</th>
                                                                        <th>Requested by</th>
                                                                        <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                @foreach($mystockrequests as $key => $request)
                                                                    @if ( $request['status']=='pending')
                                                                       <tr>
                                                                    
                                                                    <td> {{ $request?->stock?->name }}</td>
                                                                    <td>{{ $request?->requester?->name }}</td>
                                                                    <td> <a href="/stockrequestlisttreat{{$request->id}}"><button class="btn btn-warning">View</button> </a></td>
                                                                   
                                                                        </tr>
                                                                    
                                                                    @endif

                                                                    
                                                                @endforeach
                                                                	</tbody>
                                                                    </table>
                                                                


                                                                </div>
                        
					
                                                                @else
                                                                <p>No Backlog Task for Project</p>
                                                                @endunless

                                                                
                                                
                                                        </div>
                                                    </div>
                                            
                                        </div>
                                    </div>


                                  <div class="col-lg-6 col-sm-12">
                                        <h1 class="text-success">Approved</h1>
                                        <div class="card" style="padding-bottom: 30px;">
                                            
                                                    <div class=" radius-10">
                                                        <div class="card-header">
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <h4 class="mb-0 text-success">Approved</h4>
                                                                </div>

                                                            </div>
                                                        </div>



                                                        <div class="card-body" style="padding-top: 30px;">
                                                            @unless (count($mystockrequests)==0)
                                                            <div class="table-responsive">


                                                                <table id="approved" class="table" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            
                                                                        <th>Stock Name</th>
                                                                        <th>Requested by</th>
                                                                        <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                @foreach($mystockrequests as $key => $request)
                                                                    @if ( $request['status']=='approved')
                                                                       <tr>
                                                                    
                                                                    <td> {{ $request?->stock?->name }}</td>
                                                                    <td>{{ $request?->requester?->name }}</td>
                                                                    <td> <a href="/stockrequestlisttreat{{$request->id}}"><button class="btn btn-success">View</button> </a></td>
                                                                   
                                                                        </tr>
                                                                    
                                                                    @endif

                                                                    
                                                                @endforeach
                                                                	</tbody>
                                                                    </table>
                                                                


                                                                </div>
                        
					
                                                                @else
                                                                <p>No Backlog Task for Project</p>
                                                                @endunless

                                                                
                                                
                                                        </div>
                                                    </div>
                                            
                                        </div>
                                  </div>





                                      <div class="col-lg-6 col-sm-12">
                                        <h1 class="text-info">Disbursed</h1>
                                        <div class="card" style="padding-bottom: 30px;">
                                            
                                                    <div class=" radius-10">
                                                        <div class="card-header">
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <h4 class="mb-0 text-info">Disbursed</h4>
                                                                </div>

                                                            </div>
                                                        </div>



                                                        <div class="card-body" style="padding-top: 30px;">
                                                            @unless (count($mystockrequests)==0)
                                                            <div class="table-responsive">


                                                                <table id="disbursed" class="table" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            
                                                                        <th>Stock Name</th>
                                                                        <th>Requested by</th>
                                                                        <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                @foreach($mystockrequests as $key => $request)
                                                                    @if ( $request['status']=='disbursed')
                                                                       <tr>
                                                                    
                                                                    <td> {{ $request?->stock?->name }}</td>
                                                                    <td>{{ $request?->requester?->name }}</td>
                                                                    <td> <a href="/stockrequestlisttreat{{$request->id}}"><button class="btn btn-info">View</button> </a></td>
                                                                   
                                                                        </tr>
                                                                    
                                                                    @endif

                                                                    
                                                                @endforeach
                                                                	</tbody>
                                                                    </table>
                                                                


                                                                </div>
                        
					
                                                                @else
                                                                <p>No Backlog Task for Project</p>
                                                                @endunless

                                                                
                                                
                                                        </div>
                                                    </div>
                                            
                                        </div>
                                    </div>


                                      <div class="col-lg-6 col-sm-12">
                                        <h1 class="text-danger">Rejected</h1>
                                        <div class="card" style="padding-bottom: 30px;">
                                            
                                                    <div class=" radius-10">
                                                        <div class="card-header">
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <h4 class="mb-0 text-danger">Rejected</h4>
                                                                </div>

                                                            </div>
                                                        </div>



                                                        <div class="card-body" style="padding-top: 30px;">
                                                            @unless (count($mystockrequests)==0)
                                                            <div class="table-responsive">


                                                                <table id="rejected" class="table" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            
                                                                        <th>Stock Name</th>
                                                                        <th>Requested by</th>
                                                                        <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                @foreach($mystockrequests as $key => $request)
                                                                    @if ( $request['status']=='rejected')
                                                                       <tr>
                                                                    
                                                                    <td> {{ $request?->stock?->name }}</td>
                                                                    <td>{{ $request?->requester?->name }}</td>
                                                                    <td> <a href="/stockrequestlisttreat{{$request->id}}"><button class="btn btn-danger">View</button> </a></td>
                                                                   
                                                                        </tr>
                                                                    
                                                                    @endif

                                                                    
                                                                @endforeach
                                                                	</tbody>
                                                                    </table>
                                                                


                                                                </div>
                        
					
                                                                @else
                                                                <p>No Backlog Task for Project</p>
                                                                @endunless

                                                                
                                                
                                                        </div>
                                                    </div>
                                            
                                        </div>
                                    </div>
                                    
                                       
                            </div>

                        
					</div>
				</div>

            </div>
        </div>
                


</x-layout>