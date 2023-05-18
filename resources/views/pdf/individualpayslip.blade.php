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
    <center><h2>Employee Payslip</h2>
		<h3>Staff Name: <b>{{ app\Http\Controllers\Controller::staffname($payslips[0]->staff) }}</b></h3>
	</center>
	<hr />
	<div style="width: 100%; margin-top: 0px; padding-left: 20px;">
        <div style="width: 40%; float:left; margin-right: 20px;">
            <h4>Designation: {{ app\Http\Controllers\Controller::getlevelname($payslips[0]->designation) }}</h4>
            <h4>Basic Pay: N{{ number_format($payslips[0]->basicpay, 2) }}</h4>
        </div>
        <div style="width: 40%; float: right;">
            <h4>Month: {{ $payslips[0]->month }}</h4>
            <h4>Emplyer Pension: N{{ number_format($employerdeductions, 2) }}</h4>
        </div>
    </div>

    
		
    
    <div style="margin-top: 70px;">
			
			<table class="table table-bordered">
				<thead>
					<tr style="background-color: #0000ff; color: #fff">
						<th style="background-color: #0000ff; color: #fff">Allowances (N)</a></th>
						<th style="background-color: #0000ff; color: #fff">Allowed Deductions (N)</a></th>
					</tr>
				</thead>
				<tbody>
					@php $total = $allowances->count() @endphp
					@for($i=0; $i<$total; $i++)
					<tr>
						<td>
							@isset($allowances[$i]->allowance)
							<b>{{ $allowances[$i]->allowance }}:</b> N{{ number_format($allowances[$i]->amount, 2) }}
							@endisset
						</td>
						<td>
							@isset($deductions[$i]->deduction)
							<b>{{ $deductions[$i]->deduction }}:</b> N{{ number_format($deductions[$i]->amount, 2) }}
							@endisset
						</td>
					</tr>
					@endfor

					<tr>
						<td></td>
						<td></td>
					</tr>

					<tr style="background-color: #60A3D9; color: #fff">
						<th style="background-color: #60A3D9; color: #fff">Staff Bonuses (N)</a></th>
						<th style="background-color: #60A3D9; color: #fff">Staff Deductions (N)</a></th>
					</tr>

					<tr>
						<td>
							@isset($bonuses[0]->bonus)
							@php $bonus = $bonuses[0]->amount @endphp
							<b>{{ $bonuses[0]->bonus }}:</b> N{{ number_format($bonuses[0]->amount, 2) }}
							@else
							@php $bonus = 0 @endphp
							<b>Total Bonuses:</b> N{{ number_format(0, 2) }}
							@endisset
						</td>
						<td>
							@isset($staffdeductions[0]->deduction)
							@php $staffdeduction = $staffdeductions[0]->amount @endphp
							<b>{{ $staffdeductions[0]->deduction }}:</b> N{{ number_format($staffdeductions[0]->amount, 2) }}
							@else
							@php $staffdeduction = 0 @endphp
							<b>Total Deductions:</b> N{{ number_format(0, 2) }}
							@endisset
						</td>
					</tr>
					
				</tbody>
				<tfoot>
					<tr>
						<th style="background-color: #0000ff; color: #fff">Gross Pay: N{{ number_format($payslips[0]->grosspay, 2) }}</th>
						<th style="background-color: #0000ff; color: #fff">Net Pay: N{{ number_format($payslips[0]->netpay, 2) }} </th>
					</tr>
				</tfoot>
					
			</table>
		</div>
		
	


    <div style="width: 100%; margin-top: 50px; padding-left: 20px;">
        <div style="width: 40%; margin-top: 20px; float: right;">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::size(150)->generate('https://app.reliaenergy.com/staffpayslip?staff='.$payslips[0]->staff.'&month='.$payslips[0]->month)) !!} ">
        </div>
    </div>

    <div style="width: 100%; margin-top: 200px; padding-left: 20px;">
        <div style="width: 40%; float: right;">
            <h6>Payslip Generated on {{ $payslips[0]->created_at }}</h6>
        </div>
    </div>



</body>

</html>