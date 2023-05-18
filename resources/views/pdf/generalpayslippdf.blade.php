<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>

    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 50px auto;
        }

        /* Zebra striping */
        tr{
            background: #fff;
        }

        th {
            background: #eee;
            color: #000;
            font-weight: bold;
        }

        td,
        th {
            padding: 5px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 14px;
        }


    </style>

</head>

<body>
    
    <div style="width: 100%; margin-top: 0px;">
        <div style="width: 40%; float:left; margin-right: 20px;">
            <img src="data:image/png;base64,{{ $image }}" width="100" alt="" /><br />
            <p>RC: {{ $office[0]->rc }}</p>
        </div>
        <div style="width: 40%; float: right;">
            <h5>{{ $office[0]->address }}<br />{{ $office[0]->city }}, {{ $office[0]->state }}
                <br />{{ $office[0]->phone }}<br />{{ $office[0]->email }}<br />{{ $office[0]->website }}</h5>
        </div>
    </div>
    <hr style="margin-top: 120px;" />
    <center><h2>General Employee Payslip</h2>
	</center>
	<hr />
	<div style="width: 100%; margin-top: 0px; padding-left: 20px;">
        <div style="width: 40%; float:left; margin-right: 20px;">
            <h4>Month: {{ $payrolls[0]->month }}</h4>
        </div>
        <div style="width: 40%; float: right;">
            <h4>Emplyer Pension: N{{ number_format($employerdeductions, 2) }}</h4>
        </div>
    </div>

    
		
    
    <div style="margin-top: 40px;">
			
			<table class="table">
				<thead>
					<tr style="background-color: #0000ff; color: #fff">
						<th>SN</th>
						<th>Month</th>
						<th>Staff</th>
						<th>Designation</th>
						<th>Basic Pay (N)</th>
						<th>Allowances (N)</th>
						<th>Gross Pay (N)</th>
						<th>Allowed Deductions (N)</th>
						<th>Staff Bonuses (N)</th>
						<th>Staff Deductions (N)</th>
						<th>Net Pay (N)</th>
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
		
	


    <div style="width: 100%; margin-top: 50px; padding-left: 20px;">
        <div style="width: 40%; margin-top: 20px; float: right;">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::size(150)->generate('https://app.reliaenergy.com/payrolldetails?id='.$payrolls[0]->id)) !!} ">
        </div>
    </div>

    <div style="width: 100%; margin-top: 200px; padding-left: 20px;">
        <div style="width: 40%; float: right;">
            <h6>Payroll Generated on {{ $payrolls[0]->created_at }}</h6>
        </div>
    </div>



</body>

</html>