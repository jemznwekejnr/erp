<x-layout>
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Stocks</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><a href="/stocks"><i class="bx bx-user"></i></a>
								</li>
								<li class="breadcrumb-item " aria-current="page">Stock Records</li>
							</ol>
						</nav>
					</div>

				</div>
				
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
					<div class="col">
						<div class="card radius-10 border-warning border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h4 class="my-1 text-warning">{{ $categories}}</h4>
										<p class="mb-0">Categories</p>
										
									</div>
									<div class="text-warning ms-auto font-35">
										<i class='bx bxs-category'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 border-primary border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h4 class="my-1 text-primary">{{$stocks->count()}}</h4>
										<p class="mb-0">Total Items</p>
										
									</div>
									<div class="text-primary ms-auto font-35"><i class='bx bx-sitemap'></i>
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
										<p class="mb-0">Total item cost</p>
										<h4 class="my-1 text-success ">{{number_format($amount, 2) }}</h4>
									</div>
									<div class="text-success ms-auto font-35">&#8358;
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10  border-danger border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										
										<h4 class="text-danger my-1">{{number_format($low)}}</h4>
										<p class="mb-0">Items low in stock</p>
									</div>
									<div class="text-danger ms-auto font-35"><i class='bx bx-line-chart-down' ></i>
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
								
			                	<h6 class="mb-0 text-uppercase">ALl Stock Table</h6>
							</div>
						 	<div class="col-sm-6">
								<a href="/stockcreate" style=" 
					position: relative;
					float: right;
					"><button class="btn btn-success"> + Add Stock </button> </a>
												</div>
				</div>


			</div>
		</div>
                <br />


   
				<div class="card" style="padding: 20px;">
					<div class="card-body">
                        <div class="card-title">
							<x-flash-message />
							<h4 class="mb-0">All Stock </h4>
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
										<th>Last Purchased</th>
										<th>Total Amount </th>
										<th>In Stock</th>
                                        <th>Supplier</th>
                                        <th>status</th>
                                      
									</tr>
								</thead>
								<tbody>
                                    @unless (count($stocks)==0)
                                        
                                            @foreach($stocks as $key => $stock)
										  @php

											// $startDate = \Carbon\Carbon::parse($project->start_date);
                                          
										 	// $endDate = \Carbon\Carbon::parse($project->end_date);

											// $numberOfDays = $endDate->diffInDays($startDate);
                         


											@endphp 
                                            
                                            <tr>
                                                <td><a href="/stock/{{$stock->id}}">{{ $key+1}}  </a></td>
                                                <td> <img src ="{{asset($stock->image) }}"  width="50px;"/> </td>
                                                <td>{{ $stock->name }}</td>
                                                <td>{{ $stock->stock_id }}</td>
												
                                                <td>{{ $stock->categories->name }}</td>
                                                <td>{{ number_format($stock->qty_purchased) }}</td>
                                                <td><b>&#8358; {{number_format($stock->total_amount,2)}} </b></td>
                                                <td>{{ number_format($stock->qty_in_stock) }}</td>
                                                <td>{{ $stock->supplier }}</td>
                                                <td>
                                                        <a href="/stock{{$stock->id}}">
                                                                @if($stock->qty_in_stock > 0)
                                                                <button type="button" class="btn btn-success btn-sm">In Stock</button>
                            
                                                                @else
                                                                <button type="button" class="btn btn-danger btn-sm"> Out of Stock</button>
                                                                @endif
                                                        </a>
                                                    
                                                 </td>
                                              </tr>
                                          
                                            @endforeach
                                    @else
                                    <p>No Stocks found</p>
                                    @endunless
								</tbody>
							</table>
                           


						</div>
                        
					</div>
				</div>
                


</x-layout>