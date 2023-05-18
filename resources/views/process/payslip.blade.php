<div class="card">
	<div class="card-body">
		<div class="card-title">
			<h4 class="mb-0">Staff Payslip for {{ $month }}</h4>
		</div>
		<hr/>

		<form method="POST" action="submitpayroll" id="submitpayroll">
				@csrf
		<div class="table-responsive">
			<input type="hidden" name="month" value="{{ $month }}">
			<table class="table">
				<thead>
					<tr style="background-color: #0000ff; color: #fff">
						<th>SN</th>
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
					@php $basic=0 @endphp
					@php $allowance=0 @endphp
					@php $gross=0 @endphp
					@php $adeduction=0 @endphp
					@php $bonus=0 @endphp
					@php $sdeduction=0 @endphp
					@php $net=0 @endphp
					@php $i=1 @endphp
					@foreach($staffs as $staff)
					@if($staff->id != 1)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $staff->surname }} {{ $staff->firstname }} {{ $staff->othername }}</td>
						<input type="hidden" name="staff[]" value="{{ $staff->id }}">
						<td>{{ app\Http\Controllers\Controller::getlevelname($staff->designation) }}</td>
						<input type="hidden" name="designation[]" value="{{ $staff->designation }}">
						<td>{{ number_format(app\Http\Controllers\Controller::getbasicpay($staff->designation)) }}</td>
						<input type="hidden" name="basicpay[]" value="{{ round(app\Http\Controllers\Controller::getbasicpay($staff->designation)) }}">
						@php $basic += round(app\Http\Controllers\Controller::getbasicpay($staff->designation)) @endphp
						<td><a href="{{ url('allowanceslip') }}" target="_blank">{{ number_format(app\Http\Controllers\Controller::annualallowances($staff->designation) / 12) }}</a></td>
						<input type="hidden" name="allowances[]" value="{{ round(app\Http\Controllers\Controller::annualallowances($staff->designation) / 12) }}">
						@php $allowance += round(app\Http\Controllers\Controller::annualallowances($staff->designation) / 12) @endphp
						<td>{{ number_format(app\Http\Controllers\Controller::annualgross($staff->designation) / 12) }}</td>
						<input type="hidden" name="grosspay[]" value="{{ round(app\Http\Controllers\Controller::annualgross($staff->designation) / 12) }}">
						@php $gross += round(app\Http\Controllers\Controller::annualgross($staff->designation) / 12) @endphp
						<td><a href="{{ url('deductionslip') }}" target="_blank">{{ number_format(app\Http\Controllers\Controller::annualdeduction($staff->designation) / 12) }}</a></td>
						<input type="hidden" name="alloweddeductions[]" value="{{ round(app\Http\Controllers\Controller::annualdeduction($staff->designation) / 12) }}">
						@php $adeduction += round(app\Http\Controllers\Controller::annualdeduction($staff->designation) / 12) @endphp
						<td>{{ number_format(app\Http\Controllers\Controller::staffbonuses($staff->id, $month, 'Unpaid')) }}</td>
						<input type="hidden" name="staffbonuses[]" value="{{ round(app\Http\Controllers\Controller::staffbonuses($staff->id, $month, 'Unpaid')) }}">
						@php $bonus += round(app\Http\Controllers\Controller::staffbonuses($staff->id, $month, 'Unpaid')) @endphp
						<td>{{ number_format(app\Http\Controllers\Controller::staffdeductions($staff->id, $month, 'Unpaid')) }}</td>
						<input type="hidden" name="staffdeductions[]" value="{{ round(app\Http\Controllers\Controller::staffdeductions($staff->id, $month, 'Unpaid')) }}">
						@php $sdeduction += round(app\Http\Controllers\Controller::staffdeductions($staff->id, $month, 'Unpaid')) @endphp
						<td>{{ number_format(app\Http\Controllers\Controller::getnetpay($staff->designation, $staff->id, $month, 'Unpaid')) }}</td>
						<input type="hidden" name="netpay[]" value="{{ round(app\Http\Controllers\Controller::getnetpay($staff->designation, $staff->id, $month, 'Unpaid')) }}">
						@php $net += round(app\Http\Controllers\Controller::getnetpay($staff->designation, $staff->id, $month, 'Unpaid')) @endphp
					</tr>
				</tbody>
					@endif
					@endforeach

					<tfoot style="padding-top: 20px;">
					<tr style="background-color: #0000ff; color: #fff">
						<th></th>
						<th>No of Staff: {{ --$i }}</th>
						<input type="hidden" name="totalstaff" value="{{ $i }}">
						<th></th>
						<th>{{ number_format($basic) }}</th>
						<input type="hidden" name="totalbasic" value="{{ round($basic) }}">
						<th>{{ number_format($allowance) }}</th>
						<input type="hidden" name="totalallowance" value="{{ round($allowance) }}">
						<th>{{ number_format($gross) }}</th>
						<input type="hidden" name="totalgross" value="{{ round($gross) }}">
						<th>{{ number_format($adeduction) }}</th>
						<input type="hidden" name="totaladeduction" value="{{ round($adeduction) }}">
						<th>{{ number_format($bonus) }}</th>
						<input type="hidden" name="totalbonus" value="{{ round($bonus) }}">
						<th>{{ number_format($sdeduction) }}</th>
						<input type="hidden" name="totalsdeduction" value="{{ round($sdeduction) }}">
						<th>{{ number_format($net) }}</th>
						<input type="hidden" name="totalnet" value="{{ round($net) }}">
					</tr>
					</tfoot>
			</table>
		</div>
		<div class="row" style="margin-top: 30px;">
		<div class="col-sm-6">
		<select name="sendto" id="sendto" class="form-control" required>
			<option value="" selected disabled>Select Recipient</option>
			@foreach($staffs as $staff)
		    @if(Auth::user()->name != $staff->firstname.' '.$staff->surname.' '.$staff->othername)
		    @if($staff->id != 1)
		    <option value="{{ $staff->id }}">{{ $staff->firstname.' '.$staff->surname.' '.$staff->othername }}</option>
		    @endif
		    @endif
		    @endforeach
		</select>
		</div>
		<div class="col-sm-6">
		<select name="copy" id="copy" class="form-control">
			<option value="" selected disabled>Select CC</option>
			@foreach($staffs as $staff)
		    @if(Auth::user()->name != $staff->firstname.' '.$staff->surname.' '.$staff->othername)
		    @if($staff->id != 1)
		    <option value="{{ $staff->id }}">{{ $staff->firstname.' '.$staff->surname.' '.$staff->othername }}</option>
		    @endif
		    @endif
		    @endforeach
		</select>
		</div>

	</div>
	<div class="row" style="margin-top: 50px;">
	<div class="col-sm-10">
					 		
			<p id="signature"><img src="{{ asset(app\Http\Controllers\Controller::staffsignature(Auth::user()->profileid)) }}" width="150px"></p>
			<p id="sender"><b>{{ app\Http\Controllers\Controller::staffname(Auth::user()->profileid) }}</b><br />
			{{ app\Http\Controllers\Controller::getlevelname(app\Http\Controllers\Controller::staffdesignation(Auth::user()->profileid)) }}<br />
			{{ date('d/m/Y H:i:s') }}
			</p>
				
	 	</div>

		<div class="col-sm-2 text-right float-right" style="margin-top: 50px;">
				<button class="btn btn-info" type="submit" id="buttons">Submit</button>
				<img src="{{ asset('assets/images/processing.gif') }}" width="50px;" id="processings" class="processing" style="display: none;">
		</div>
	</div>
		</form>
	</div>
</div>

<script>
	$("#submitpayroll").on('submit', function(event){
	      event.preventDefault();
	      
	      $.ajax({
	        type: 'POST',
	        url: 'submitpayroll',
	        data: new FormData(this),
	        contentType: false,
	        cache: false,
	        processData: false,
	        beforeSend:function(){
	                $("#buttons").hide();
	                $("#processings").show();
	            },
	        success: function(data){

	        if(data.message == 'success'){
	        	Swal.fire('Success!', data.info, 'success');
	        	setTimeout(function() {
				    window.location = '/payrolldetails?id='+id;
				}, 3000);
	        }else{
	        	Swal.fire("Error!", data.info, "error");
	        }
	          
              $("#buttons").show();
              $("#processings").hide();
	        }
	      });
	    });
</script>