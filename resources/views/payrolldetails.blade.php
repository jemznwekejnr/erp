@include("layouts.app-title")
<body>
@include("layouts.app-sidebar")
@include("layouts.app-header")
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0" style="background-color: transparent;">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-copy"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">General Employee Payslip</li>
							</ol>
						</nav>
					</div>

					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{ url('generalpayslippdf?id='.$payrolls[0]->id) }}" target="_blank" class="btn btn-danger">Generate PDF</a>
							
						</div>
					</div>
				</div>
				<!--end breadcrumb-->

		<div id="payslipview">
			<div class="card">
	<div class="card-body">
		<div class="card-title">
		<div class="row">
			<div class="col-sm-8">
			<h4 class="mb-0">General Staff Payslip for {{ $payrolls[0]->month }}</h4>
			</div>
			<div class="col-sm-4 text-right float-right">
				@if($payrolls[0]->status == "Paid")
				<button class="btn btn-success btn-sm" type="button">{{ $payrolls[0]->status }}</button>
				@elseif($payrolls[0]->status == "Approved")
				<button class="btn btn-info btn-sm" type="button">{{ $payrolls[0]->status }}</button>
				@elseif($payrolls[0]->status == "Pending")
				<button class="btn btn-warning btn-sm" type="button">{{ $payrolls[0]->status }}</button>
				@elseif($payrolls[0]->status == "Rejected")
				<button class="btn btn-danger btn-sm" type="button">{{ $payrolls[0]->status }}</button>
				@endif
			</div>
		</div>
		<hr/>
		<form method="POST" action="updatepayroll" id="updatepayroll">
				@csrf
		<div class="table-responsive">
			
			<table class="table">
				<thead>
					<tr style="background-color: #0000ff; color: #fff">
						<th>SN</th>
						<th>Month</th>
						<th>Staff</th>
						<th>Designation</th>
						<th>Basic Pay (&#8358;)</th>
						<th><a href="{{ url('allowanceslip') }}" target="_blank" style="background-color: #0000ff; color: #fff">Allowances (&#8358;)</a></th>
						<th>Gross Pay (&#8358;)</th>
						<th><a href="{{ url('deductionslip') }}" target="_blank" style="background-color: #0000ff; color: #fff">Allowed Deductions (&#8358;)</a></th>
						<th>Staff Bonuses (&#8358;)</th>
						<th>Staff Deductions (&#8358;)</th>
						<th>Net Pay (&#8358;)</th>
					</tr>
				</thead>
				<tbody>
					@php $i=1 @endphp
					@foreach($payslips as $payslip)
					@if($payslip->staff != 1)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $payslip->month }}</td>
						<td><a href="{{ url('staffpayslip?staff='.$payslip->staff.'&month='.$payslip->month) }}" style="colo: #000 !important">{{ app\Http\Controllers\Controller::staffname($payslip->staff) }}</a></td>
						<td>{{ app\Http\Controllers\Controller::getlevelname($payslip->designation) }}</td>
						<td>{{ number_format($payslip->basicpay, 2) }}</td>
						<td>
							@php $staffallowances = app\Http\Controllers\Controller::getstaffallowances($payslip->staff) @endphp
							@foreach($staffallowances as $staffallowance)
							<b>{{ $staffallowance->allowance }}:</b> {{ number_format($staffallowance->amount, 2) }}<br />
							@endforeach
							<b>Total:</b> {{ number_format($payslip->allowances, 2) }}</td>
						<td>{{ number_format($payslip->grosspay, 2) }}</td>
						<td>
							@php $staffdeductions = app\Http\Controllers\Controller::getstaffdeductions($payslip->staff) @endphp
							@foreach($staffdeductions as $staffdeduction)
							<b>{{ $staffdeduction->deduction }}:</b> {{ number_format($staffdeduction->amount, 2) }}<br />
							@endforeach
							<b>Total:</b> {{ number_format($payslip->alloweddeduction, 2) }}</td>
						<td>{{ number_format($payslip->staffbonus, 2) }}</td>
						<td>{{ number_format($payslip->staffdeduction, 2) }}</td>
						<td>{{ number_format($payslip->netpay, 2) }}</td>
					</tr>
				</tbody>
					@endif
					@endforeach

					<tfoot style="padding-top: 20px;">
					<tr style="background-color: #0000ff; color: #fff">
						<th></th>
						<th>Total Staff: {{ --$i }}</th>
						<th></th>
						<th></th>
						<th>{{ number_format($payrolls[0]->basicpay) }}</th>
						<th>{{ number_format($payrolls[0]->allowances) }}</th>
						<th>{{ number_format($payrolls[0]->grosspay) }}</th>
						<th>{{ number_format($payrolls[0]->alloweddeduction) }}</th>
						<th>{{ number_format($payrolls[0]->staffbonus) }}</th>
						<th>{{ number_format($payrolls[0]->staffdeduction) }}</th>
						<th>{{ number_format($payrolls[0]->netpay) }}</th>
					</tr>
					</tfoot>
			</table>
		</div>
		
	<div class="row" style="margin-top: 50px;">
	<div class="col-sm-6">
					 		
		<p id="signature"><img src="{{ asset(app\Http\Controllers\Controller::staffsignature($payrolls[0]->created_by)) }}" width="150px"></p>
		<p id="sender"><b>{{ app\Http\Controllers\Controller::staffname($payrolls[0]->created_by) }}</b><br />
		{{ app\Http\Controllers\Controller::getlevelname(app\Http\Controllers\Controller::staffdesignation($payrolls[0]->created_by)) }}<br />
		{{ date('d/m/Y H:i:s') }}
		</p>
			
 	</div>

 	<div class="col-sm-6 float-right text-right">
					 		
		<p id="signature"><img src="{{ asset(app\Http\Controllers\Controller::staffsignature(Auth::user()->profileid)) }}" width="150px"></p>
		<p id="sender"><b>{{ app\Http\Controllers\Controller::staffname(Auth::user()->profileid) }}</b><br />
		{{ app\Http\Controllers\Controller::getlevelname(app\Http\Controllers\Controller::staffdesignation(Auth::user()->profileid)) }}<br />
		{{ date('d/m/Y H:i:s') }}
		</p>
			
 	</div>

 	</div>

 	<div class="row" style="margin-top: 30px;">
		<div class="col-sm-6">
		<input type="hidden" name="id" value="{{ $payrolls[0]->id }}">
		<input type="hidden" name="month" value="{{ $payrolls[0]->month }}">
		<select name="status" class="form-control" required>
			<option>{{ $payrolls[0]->status }}</option>
		    <option>Paid</option>
		    <option>Approved</option>
		    <option>Pending</option>
		    <option>Rejected</option>
		</select>
		</div>

	<div class="col-sm-6 text-right float-right">
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
<!--end page wrapper -->
@include("layouts.app-footer")
@include("process.payroll")