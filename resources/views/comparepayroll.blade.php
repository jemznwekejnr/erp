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
							<h4 class="mb-0">Compare Two Payslip</h4>
						</div>
					</div>
				</div>
				  <div class="card-body">
				  	<div class="form-body">
					 <form class="row g-2" method="POST" action="generatepayslip" id="generatepayslip">
					 	@csrf
					 	<div class="col-sm-6">
					 		
					 		<input type="month" name="month" id="compare1" class="form-control">
						
					 	</div>
					 	<div class="col-sm-6">

					 		<input type="month" name="month" id="compare2" class="form-control">
						
					 	</div>
					 </form>
					 </div>
				  </div>
			  </div>
		   </div>
		</div>
		<div class="col-sm-16" id="compare1div">
			
		</div>
		<div class="col-sm-16" id="compare2div">
			
		</div>
	</div>
</div>
<!--end page wrapper -->
@include("layouts.app-footer")
@include("process.payroll")