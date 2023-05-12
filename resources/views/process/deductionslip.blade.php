@include("layouts.app-title")
<body>
@include("layouts.app-sidebar")
@include("layouts.app-header")
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">

		<div class="card">
	<div class="card-body">
		<div class="card-title">
			<h4 class="mb-0">Allowed Deductions</h4>
		</div>
		<hr/>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr style="background-color: #0000ff; color: #fff">
						<th>SN</th>
						<th>Staff</th>
						@foreach($deductions as $deduction)
						<th>{{ $deduction->deduction }} (&#8358;)</th>
						@endforeach
						<th>Total (&#8358;)</th>
					</tr>
				</thead>
				<tbody>
					@php $i=1 @endphp
					@foreach($staffs as $staff)
					@if($staff->id != 1)
					@php $sum=0 @endphp
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $staff->surname }} {{ $staff->firstname }} {{ $staff->othername }}</td>
						@foreach($deductions as $deduction)
						<td>{{ number_format($staffdeductions[$staff->id][$deduction->deduction]) }}</td>
						@php $sum += round($staffdeductions[$staff->id][$deduction->deduction]) @endphp
						@endforeach
						<td>{{ number_format($sum) }}</td>
					</tr>
					@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

	</div>
</div>
<!--end page wrapper -->
@include("layouts.app-footer")
@include("process.payroll")