@include("layouts.app-title")
<body>
@include("layouts.app-sidebar")
@include("layouts.app-header")
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<div class="card">
		       <div class="col-12 col-lg-12">
		          <div class=" radius-10">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<div>
							<h4 class="mb-0">Add New Deduction</h4>
						</div>
					</div>
				</div>
				  <div class="card-body">
				  	<div class="form-body">
					 <form class="row g-2" method="POST" action="submitdeduction" id="submitdeduction">
					 	@csrf
					 	<div class="row">
					 	<div class="col-sm-4">
					 		<input type="hidden" name="deductionid" id="deductionid" value="">
					 		<select name="staff[]" id="staff" multiple class="form-control" required>
					 			@foreach($staffs as $staff)
					 			@if($staff->id != 1)
					 			<option value="{{ $staff->id }}">{{ $staff->surname.' '.$staff->firstname.' '.$staff->othername }}</option>
					 			@endif
					 			@endforeach
					 		</select>

						
					 	</div>
					 	<div class="col-sm-8">
					 		
					 		<input type="text" name="description" id="description" class="form-control" placeholder="Enter Bonus Description" required>

						
					 	</div>
					 	</div>

					 	<div class="row" style="margin-top: 15px;">

					 	<div class="col-sm-4">
					 		<input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount (N)" required>
						
					 	</div>
					 	<div class="col-sm-3">

					 		<input type="month" name="month" id="month" class="form-control" title="Start Month" required>
						
					 	</div>
					 	<div class="col-sm-3">

					 		
						
					 	</div>

					 	<div class="col-sm-2 text-right float-right">
								<button class="btn btn-info" type="submit" id="button">Submit</button>
								<img src="{{ asset('assets/images/processing.gif') }}" width="50px;" id="processing" class="processing" style="display: none;">
						</div>
						</div>
					 </form>
					 </div>
				  </div>
			  </div>
		   </div>
		</div>

		<div class="card">
					<div class="card-body">
						<div class="card-title">
							<h4 class="mb-0">Available Deductions</h4>
						</div>
						<hr/>
						<div class="table-responsive">
							<table id="example" class="table table-striped example">
								<thead>
									<tr>
										<th>SN</th>
										<th>Staff</th>
										<th>Amount (&#8358;)</th>
										<th>Month</th>
										<th>Description</th>
										<th>Status</th>
										<th>Created At</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $i=1 @endphp
									@foreach($deductions as $deduction)
									<tr>
										<td>{{ $i++ }}</td>
										<td>{{ app\Http\Controllers\Controller::staffname($deduction->staff) }}</td>
										<td>{{ number_format($deduction->amount, 2) }}</td>
										<td>{{ $deduction->month }}</td>
										<td>{{ $deduction->deduction }}</td>
										@if($deduction->status == "Unpaid")
										<td><button class="btn btn-danger btn-sm" type="button">{{ $deduction->status }}</button></td>
										@else
										<td><button class="btn btn-success btn-sm" type="button">{{ $deduction->status }}</button></td>
										@endif
										<td>{{ $deduction->created_at }}</td>
										<td>
											
											<a href="{{ $deduction->id }}" class="editdeduction" id="{{ $deduction->staff }}|{{ $deduction->deduction }}"  title="{{ $deduction->amount }}|{{ $deduction->month }}"><svg title="Click to edit row" class="vouchericon" id="editrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m19.3 8.925l-4.25-4.2l1.4-1.4q.575-.575 1.413-.575t1.412.575l1.4 1.4q.575.575.6 1.388t-.55 1.387L19.3 8.925ZM17.85 10.4L7.25 21H3v-4.25l10.6-10.6l4.25 4.25Z"/></svg></a>

											<a href="{{ $deduction->id }}" class="deletededuction" id="{{ $deduction->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z"/></svg></a>

										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
	</div>
</div>
<!--end page wrapper -->
@include("layouts.app-footer")
@include("process.payroll")