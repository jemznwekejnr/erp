@include("layouts.app-title")
<body>
@include("layouts.app-sidebar")
@include("layouts.app-header")
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		

		<div id="payslipview">
			<div class="card">
	<div class="card-body">
		<div class="card-title">
		<center><h2>Payslip</h2>
			<h3>Staff Name: <b>{{ app\Http\Controllers\Controller::staffname($payslips[0]->staff) }}</b></h3>
		</center>
		<div class="row">
			<div class="col-sm-6">Designation: {{ app\Http\Controllers\Controller::getlevelname($payslips[0]->designation) }}</div>
			<div class="col-sm-3">Basic Pay: &#8358;{{ number_format($payslips[0]->basicpay, 2) }}</div>
			<div class="col-sm-3">Month: {{ $payslips[0]->month }}</div>
		</div>
		<hr/>
		
		<div class="table-responsive">
			
			<table class="table table-bordered">
				<thead>
					<tr style="background-color: #0000ff; color: #fff">
						<th><a href="{{ url('allowanceslip') }}" target="_blank" style="background-color: #0000ff; color: #fff">Allowances (&#8358;)</a></th>
						<th><a href="{{ url('deductionslip') }}" target="_blank" style="background-color: #0000ff; color: #fff">Allowed Deductions (&#8358;)</a></th>
					</tr>
				</thead>
				<tbody>
					@php $i=0 @endphp
					@foreach($allowances as $allowance)
					<tr>
						<td><b>{{ $allowance->allowance }}:</b> &#8358;{{ number_format(($allowance->percentage / 100) * $payslips[0]->basicpay) }}</td>
					</tr>
					@endforeach

					
					</tr>
				</tbody>
					

					
			</table>
		</div>
		
	<div class="row" style="margin-top: 50px;">
	<div class="col-sm-6">
					 		
		<p id="signature"><img src="{{ asset(app\Http\Controllers\Controller::staffsignature($payslips[0]->created_by)) }}" width="150px"></p>
		<p id="sender"><b>{{ app\Http\Controllers\Controller::staffname($payslips[0]->created_by) }}</b><br />
		{{ app\Http\Controllers\Controller::getlevelname(app\Http\Controllers\Controller::staffdesignation($payslips[0]->created_by)) }}<br />
		{{ date('d/m/Y H:i:s') }}
		</p>
			
 	</div>

 	

 	</div>

 	
		
	</div>
</div>
		</div>
	</div>
</div>
<!--end page wrapper -->
@include("layouts.app-footer")
@include("process.payroll")