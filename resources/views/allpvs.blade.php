@include("layouts.app-title")
<body>
@include("layouts.app-sidebar")
@include("layouts.app-header")
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		
		<div class="card" style="padding: 20px;">
					<div class="card-body">
						<div class="card-title">
							<h4 class="mb-0">All Payment Vouchers</h4>
						</div>
						<hr/>
						<div class="form-body">
					 <form class="row g-2" method="POST" action="generatepayslip" id="generatepayslip">
					 	@csrf
					 	<div class="col-sm-2">
					 		
					 		<input type="month" name="month" id="month" class="form-control">
						
					 	</div>
					 	<div class="col-sm-2">
					 		<select name="year" id="year" class="form-control">
					 			<option value="" selected disabled>Year</option>
					 			@for($i=2023; $i <= date('Y'); $i++)
					 			<option>{{ $i }}</option>
					 			@endfor
					 		</select>
						
					 	</div>
					 	<div class="col-sm-3">
					 		<select name="status" id="status" class="form-control">
					 			<option value="" selected disabled>Status</option>
					 			<option>Paid</option>
					 			<option>Approved</option>
					 			<option>Pending</option>
					 			<option>Rejected</option>
					 			<option>Verified</option>
					 			<option>Uploaded</option>
					 		</select>
					 	</div>
					 	<div class="col-sm-5">
					 		<input type="text" name="search" id="search" class="form-control" placeholder="Search by title">
					 	</div>
					 </form>
					 </div>
					</div>
				</div>

			<div class="card" style="padding: 20px;">
					<div class="card-body">
						<div class="table-responsive" id="showpv">
							@include("process.pvtable")
						</div>
					</div>
				</div>
	</div>
</div>
<!--end page wrapper -->
@include("layouts.app-footer")
@include("process.paymentvoucher")