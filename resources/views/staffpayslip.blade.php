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
								<li class="breadcrumb-item active" aria-current="page">Employee Payslip</li>
							</ol>
						</nav>
					</div>

					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{ url('individualpayslippdf?staff='.$payslips[0]->staff.'&month='.$payslips[0]->month) }}" target="_blank" class="btn btn-danger">Generate PDF</a>
							
						</div>
					</div>
				</div>
				<!--end breadcrumb-->

		<div id="payslipview">
			<div class="card">
	<div class="card-body">
		<div class="card-title">
		<center><h2>Employee Payslip</h2>
			<h3>Staff Name: <b>{{ app\Http\Controllers\Controller::staffname($payslips[0]->staff) }}</b></h3>
			@if($payslips[0]->status == "Paid")
			<button class="btn btn-success btn-sm" type="button">{{ $payslips[0]->status }}</button>
			@elseif($payslips[0]->status == "Approved")
			<button class="btn btn-info btn-sm" type="button">{{ $payslips[0]->status }}</button>
			@elseif($payslips[0]->status == "Pending")
			<button class="btn btn-warning btn-sm" type="button">{{ $payslips[0]->status }}</button>
			@elseif($payslips[0]->status == "Rejected")
			<button class="btn btn-danger btn-sm" type="button">{{ $payslips[0]->status }}</button>
			@endif
		</center>
		<hr />
		<div class="row">
			<div class="col-sm-4"><h4>Designation: {{ app\Http\Controllers\Controller::getlevelname($payslips[0]->designation) }}</h4></div>
			<div class="col-sm-2"><h4>Month: {{ $payslips[0]->month }}</h4></div>
			<div class="col-sm-3"><h4>Basic Pay: &#8358;{{ number_format($payslips[0]->basicpay, 2) }}</h4></div>
			<div class="col-sm-3"><h4>Emplyer Pension: &#8358;{{ number_format($employerdeductions, 2) }}</h4></div>
		</div>
		<hr/>
		
		<div class="table-responsive">
			
			<table class="table table-bordered">
				<thead>
					<tr style="background-color: #0000ff; color: #fff">
						<th style="background-color: #0000ff; color: #fff">Allowances (&#8358;)</a></th>
						<th style="background-color: #0000ff; color: #fff">Allowed Deductions (&#8358;)</a></th>
					</tr>
				</thead>
				<tbody>
					@php $total = $allowances->count() @endphp
					@for($i=0; $i<$total; $i++)
					<tr>
						<td>
							@isset($allowances[$i]->allowance)
							<b>{{ $allowances[$i]->allowance }}:</b> &#8358;{{ number_format($allowances[$i]->amount, 2) }}
							@endisset
						</td>
						<td>
							@isset($deductions[$i]->deduction)
							<b>{{ $deductions[$i]->deduction }}:</b> &#8358;{{ number_format($deductions[$i]->amount, 2) }}
							@endisset
						</td>
					</tr>
					@endfor

					<tr>
						<td></td>
						<td></td>
					</tr>

					<tr style="background-color: #60A3D9; color: #fff">
						<th style="background-color: #60A3D9; color: #fff">Staff Bonuses (&#8358;)</a></th>
						<th style="background-color: #60A3D9; color: #fff">Staff Deductions (&#8358;)</a></th>
					</tr>

					<tr>
						<td>
							@isset($bonuses[0]->bonus)
							@php $bonus = $bonuses[0]->amount @endphp
							<b>{{ $bonuses[0]->bonus }}:</b> &#8358;{{ number_format($bonuses[0]->amount, 2) }}
							@else
							@php $bonus = 0 @endphp
							<b>Total Bonuses:</b> &#8358;{{ number_format(0, 2) }}
							@endisset
						</td>
						<td>
							@isset($staffdeductions[0]->deduction)
							@php $staffdeduction = $staffdeductions[0]->amount @endphp
							<b>{{ $staffdeductions[0]->deduction }}:</b> &#8358;{{ number_format($staffdeductions[0]->amount, 2) }}
							@else
							@php $staffdeduction = 0 @endphp
							<b>Total Deductions:</b> &#8358;{{ number_format(0, 2) }}
							@endisset
						</td>
					</tr>
					
				</tbody>
				<tfoot>
					<tr>
						<th style="background-color: #0000ff; color: #fff">Gross Pay: &#8358;{{ number_format($payslips[0]->grosspay, 2) }}</th>
						<th style="background-color: #0000ff; color: #fff">Net Pay: &#8358;{{ number_format($payslips[0]->netpay, 2) }} </th>
					</tr>
				</tfoot>
					
			</table>
		</div>
		
	<div class="row" style="margin-top: 50px;">
	<div class="col-sm-6">
					 		
		<p id="signature"><img src="{{ asset(app\Http\Controllers\Controller::staffsignature($payslips[0]->created_by)) }}" width="150px"></p>
		<p id="sender"><b>{{ app\Http\Controllers\Controller::staffname($payslips[0]->created_by) }}</b><br />
		{{ app\Http\Controllers\Controller::getlevelname(app\Http\Controllers\Controller::staffdesignation($payslips[0]->created_by)) }}<br />
		{{ $payslips[0]->created_at }}
		</p>
			
 	</div>

 	<div class="col-sm-6 float-right text-right">
					 		
		<p id="signature"><img src="{{ asset(app\Http\Controllers\Controller::staffsignature($recipient)) }}" width="150px"></p>
		<p id="sender"><b>{{ app\Http\Controllers\Controller::staffname($recipient) }}</b><br />
		{{ app\Http\Controllers\Controller::getlevelname(app\Http\Controllers\Controller::staffdesignation($recipient)) }}<br />
		{{ $payslips[0]->updated_at }}
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