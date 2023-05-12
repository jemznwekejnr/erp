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
					 		<input type="month" name="month" class="form-control" required>
						
					 	</div>
					 	<div class="col-sm-6">
					 		
						
					 	</div>
					 	<div class="col-sm-2 text-right float-right">
								<button class="btn btn-warning" type="submit" id="button">Generate</button>
								<img src="{{ asset('assets/images/processing.gif') }}" width="50px;" id="processing" class="processing" style="display: none;">
						</div>
					 </form>
					 </div>
				  </div>
			  </div>
		   </div>
		</div>

		<div id="payslipview">
			
		</div>
	</div>
</div>
<!--end page wrapper -->
@include("layouts.app-footer")
@include("process.payroll")