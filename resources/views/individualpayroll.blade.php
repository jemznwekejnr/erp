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
							<h4 class="mb-0">Generate New Payslip</h4>
						</div>
					</div>
				</div>
				  <div class="card-body">
				  	<div class="form-body">
					 <form class="row g-2" method="POST" action="generatepayslip" id="generatepayslip">
					 	@csrf
					 	<div class="col-sm-4">
					 		
					 		<input type="month" name="month" id="month" class="form-control">
						
					 	</div>
					 	<div class="col-sm-4">
					 		<select name="year" id="year" class="form-control">
					 			<option value="" selected disabled>Year</option>
					 			@for($i=2023; $i <= date('Y'); $i++)
					 			<option>{{ $i }}</option>
					 			@endfor
					 		</select>
						
					 	</div>
					 	<div class="col-sm-4">
					 		<select name="status" id="status" class="form-control">
					 			<option value="" selected disabled>Status</option>
					 			<option>Paid</option>
					 			<option>Approved</option>
					 			<option>Pending</option>
					 		</select>
					 	</div>
					 </form>
					 </div>
				  </div>
			  </div>
		   </div>
		</div>

		<div id="payslipview">
			@include("process.individualpayslip")
		</div>
	</div>
</div>
<!--end page wrapper -->
@include("layouts.app-footer")
@include("process.payroll")