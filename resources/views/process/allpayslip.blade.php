<div class="card">
	<div class="card-body">
		<div class="card-title">
			<h4 class="mb-0">Staff Payroll History</h4>
		</div>
		<hr/>
		<div class="table-responsive">
			
			<table class="table">
				<thead>
					<tr style="background-color: #0000ff; color: #fff">
						<th>SN</th>
						<th>Month</th>
						<th>Total Staff</th>
						<th>Basic Pay (&#8358;)</th>
						<th><a href="{{ url('allowanceslip') }}" target="_blank" style="background-color: #0000ff; color: #fff">Allowances (&#8358;)</a></th>
						<th>Gross Pay (&#8358;)</th>
						<th><a href="{{ url('deductionslip') }}" target="_blank" style="background-color: #0000ff; color: #fff">Allowed Deductions (&#8358;)</a></th>
						<th>Staff Bonuses (&#8358;)</th>
						<th>Staff Deductions (&#8358;)</th>
						<th>Net Pay (&#8358;)</th>
						<th>Status</th>
						<th>Generated By</th>
						<th>Generated At</th>
					</tr>
				</thead>
				<tbody>
					@php $basic=0 @endphp
					@php $allowance=0 @endphp
					@php $gross=0 @endphp
					@php $adeduction=0 @endphp
					@php $bonus=0 @endphp
					@php $sdeduction=0 @endphp
					@php $net=0 @endphp
					@php $i=1 @endphp
					@foreach($payrolls as $payroll)
					<tr>
						<td>{{ $i++ }}</td>
						<td><a href="{{ url('payrolldetails?id='.$payroll->id) }}" class="btn btn-sm btn-primary"> {{ $payroll->month }}</a></td>
						<td>{{ $payroll->staff }}</td>
						<td>{{ number_format($payroll->basicpay) }}</td>
						@php $basic += round($payroll->basicpay) @endphp
						<td><a href="{{ url('allowanceslip') }}" target="_blank">{{ number_format($payroll->allowances) }}</a></td>
						@php $allowance += round($payroll->allowances) @endphp
						<td>{{ number_format($payroll->grosspay) }}</td>
						@php $gross += round($payroll->grosspay) @endphp
						<td><a href="{{ url('deductionslip') }}" target="_blank">{{ number_format($payroll->alloweddeduction) }}</a></td>
						@php $adeduction += round($payroll->alloweddeduction) @endphp
						<td>{{ number_format($payroll->staffbonus) }}</td>
						@php $bonus += round($payroll->staffbonus) @endphp
						<td>{{ number_format($payroll->staffdeduction) }}</td>
						@php $sdeduction += round($payroll->staffdeduction) @endphp
						<td>{{ number_format($payroll->netpay) }}</td>
						@php $net += round($payroll->netpay) @endphp
						<td>@if($payrolls[0]->status == "Paid")
						<button class="btn btn-success btn-sm" type="button">{{ $payroll->status }}</button>
						@elseif($payroll->status == "Approved")
						<button class="btn btn-info btn-sm" type="button">{{ $payroll->status }}</button>
						@elseif($payroll->status == "Pending")
						<button class="btn btn-warning btn-sm" type="button">{{ $payroll->status }}</button>
						@elseif($payroll->status == "Rejected")
						<button class="btn btn-danger btn-sm" type="button">{{ $payroll->status }}</button>
						@endif</td>
						<td>{{ app\Http\Controllers\Controller::staffname($payroll->created_by) }}</td>
						<td>{{ $payroll->created_at }}</td>
					</tr>
				</tbody>
					@endforeach

					<tfoot style="padding-top: 20px;">
					<tr style="background-color: #0000ff; color: #fff">
						<th></th>
						<th>Total Record: {{ --$i }}</th>
						<th></th>
						<th>{{ number_format($basic) }}</th>
						<th>{{ number_format($allowance) }}</th>
						<th>{{ number_format($gross) }}</th>
						<th>{{ number_format($adeduction) }}</th>
						<th>{{ number_format($bonus) }}</th>
						<th>{{ number_format($sdeduction) }}</th>
						<th>{{ number_format($net) }}</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					</tfoot>
			</table>
		</div>
	</div>
</div>