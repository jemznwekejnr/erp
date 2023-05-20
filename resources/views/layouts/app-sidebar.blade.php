<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true"  style="background-color: #1434A4;">
			<div class="sidebar-header" style="background-color: #1434A4;">
				<div>
					<img src="{{ asset('assets/images/RELIA-ENERGY-Logo-2020 (1).png') }}" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text" style="font-size: 20px;">Relia Energy</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{ url('dashboard') }}">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<!--<li class="menu-label">UI Elements</li>-->
				@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 1, 2) == "allow")
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
						</div>
						<div class="menu-title">Memo</div>
					</a>
					<ul>
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 1, 6) == "allow")
						<li> <a href="{{ url('creatememo') }}"><i class="bx bx-right-arrow-alt"></i>Create Memo</a>
						</li>
						@endif
						<li> <a href="{{ url('memoinbox') }}"><i class="bx bx-right-arrow-alt"></i>Memo Inbox</a>
						</li>
						<li> <a href="{{ url('sentmemo') }}"><i class="bx bx-right-arrow-alt"></i>Sent Memo</a>
						</li>
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 5, 2) == "allow")
						<li> <a href="{{ url('allmemo') }}"><i class="bx bx-right-arrow-alt"></i>All Memo</a>
						</li>
						@endif
					</ul>
				</li>
				@endif
				@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 2, 2) == "allow")
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-repeat"></i>
						</div>
						<div class="menu-title">Payment Voucher</div>
					</a>
					<ul>
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 2, 6) == "allow")
						<li> <a href="{{ url('paymentvoucher') }}"><i class="bx bx-right-arrow-alt"></i>New PV</a>
						</li>
						@endif
						<li> <a href="{{ url('sentpvs') }}"><i class="bx bx-right-arrow-alt"></i>My PV</a>
						</li>
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 6, 2) == "allow")
						<li> <a href="{{ url('allpvs') }}"><i class="bx bx-right-arrow-alt"></i>View All PVs</a>
						</li>
						@endif
						<!--<li> <a href="content-text-utilities.html"><i class="bx bx-right-arrow-alt"></i>Text Utilities</a>-->
						</li>
					</ul>
				</li>
				@endif
				<!--<li class="menu-label">Addons</li>-->
				@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 3, 2) == "allow")
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-copy"></i>
						</div>
						<div class="menu-title">Circulars</div>
					</a>
					<ul>
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 3, 6) == "allow")
						<li> <a href="{{ url('createcircular') }}"><i class="bx bx-right-arrow-alt"></i>Create Circular</a>
						</li>
						@endif
						<li> <a href="{{ url('mycirculars') }}"><i class="bx bx-right-arrow-alt"></i>View Circular</a>
						</li>
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 10, 2) == "allow")
						<li> <a href="{{ url('listcirculars') }}"><i class="bx bx-right-arrow-alt"></i>All Circulars</a>
						</li>
						@endif
						<!--<li> <a href="errors-404-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>404 Error</a></li>
						<li> <a href="error-blank-page.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Blank Page</a>
						</li>-->
					</ul>
				</li>
				@endif
				@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 4, 2) == "allow")
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-user-circle"></i>
						</div>
						<div class="menu-title">Staff</div>
					</a>
					<ul>
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 4, 6) == "allow")
						<li> <a href="{{ url('createstaff') }}"><i class="bx bx-right-arrow-alt"></i>Create Staff</a>
						</li>
						@endif
						<li> <a href="{{ url('stafftable') }}"><i class="bx bx-right-arrow-alt"></i>View Staff</a>
						</li>
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 7, 2) == "allow")
						<li> <a href="{{ url('usertable') }}"><i class="bx bx-right-arrow-alt"></i>View Users</a>
						</li>
						@endif
						<!--<li> <a href="errors-404-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>404 Error</a></li>
						<li> <a href="error-blank-page.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Blank Page</a>
						</li>-->
					</ul>
				</li>
				@endif
				@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 8, 2) == "allow")
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-video-recording"></i>
						</div>
						<div class="menu-title">Setup</div>
					</a>
					<ul>
						<li> <a href="{{ url('departments') }}"><i class="bx bx-right-arrow-alt"></i>Departments</a>
						</li>
						<li> <a href="{{ url('designations') }}"><i class="bx bx-right-arrow-alt"></i>Designations</a>
						</li>
						<li> <a href="{{ url('offices') }}"><i class="bx bx-right-arrow-alt"></i>Offices</a>
						</li>
						<li> <a href="{{ url('banks') }}"><i class="bx bx-right-arrow-alt"></i>Banks</a></li>
						<li> <a href="{{ url('companyinfo') }}"><i class="bx bx-right-arrow-alt"></i>Company Info</a>
						<li> <a href="{{ url('alllogs') }}"><i class="bx bx-right-arrow-alt"></i>System Logs</a>
						</li>
					</ul>
				</li>
				@endif
				@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 9, 2) == "allow")
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-lock"></i>
						</div>
						<div class="menu-title">Access Control</div>
					</a>
					<ul>
						<!--<li> <a href="{{ url('actions') }}"><i class="bx bx-right-arrow-alt"></i>Actions</a>
						</li>
						<li> <a href="{{ url('process') }}"><i class="bx bx-right-arrow-alt"></i>Processes</a>
						</li>-->
						<li> <a href="{{ url('roles') }}"><i class="bx bx-right-arrow-alt"></i>Roles</a>
						</li>
						<!--<li> <a href="{{ url('privileges') }}"><i class="bx bx-right-arrow-alt"></i>Privileges</a></li>-->
						<!--<li> <a href="error-blank-page.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Blank Page</a>
						</li>-->
					</ul>
				</li>
				@endif
                @if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 12, 2) == "allow")
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-video-recording"></i>
						</div>
						<div class="menu-title">Projects</div>
					</a>
					<ul>
					    @if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 12, 6) == "allow")
						<li> <a href="{{ url('createproject') }}"><i class="bx bx-right-arrow-alt"></i>New Project</a>
						</li>
						@endif
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 12, 2) == "allow")
						<li> <a href="{{ url('projects') }}"><i class="bx bx-right-arrow-alt"></i>Project List</a>
						</li>
						@endif
						<!--<li> <a href="{{ url('offices') }}"><i class="bx bx-right-arrow-alt"></i>Offices</a>
						</li>
						<li> <a href="{{ url('banks') }}"><i class="bx bx-right-arrow-alt"></i>Banks</a></li>
						--<li> <a href="error-blank-page.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Blank Page</a>
						</li>-->
					</ul>
				</li>
                @endif
                @if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 13, 2) == "allow")
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-repeat"></i>
						</div>
						<div class="menu-title">Accounts</div>
					</a>
					<ul>
					    @if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 13, 2) == "allow")
						<li> <a href="{{ url('createinvoice') }}"><i class="bx bx-right-arrow-alt"></i>New Invoice</a>
						</li>
						@endif
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 13, 6) == "allow")
						<li> <a href="{{ url('allinvoices') }}"><i class="bx bx-right-arrow-alt"></i>Client Invoices</a>
						</li>
						@endif
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 14, 2) == "allow")
						<li> <a href="{{ url('allreceipts') }}"><i class="bx bx-right-arrow-alt"></i>Client Receipts</a>
						</li>
						@endif
						<!--<li> <a href="{{ url('banks') }}"><i class="bx bx-right-arrow-alt"></i>Banks</a></li>
						--<li> <a href="error-blank-page.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Blank Page</a>
						</li>-->
					</ul>
				</li>
				@endif
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-repeat"></i>
						</div>
						<div class="menu-title">Leave</div>
					</a>
					<ul>
					    @if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 13, 2) == "allow")
						<li> <a href="{{ url('leaverequest') }}"><i class="bx bx-right-arrow-alt"></i>Leave Application</a>
						</li>
						@endif
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 13, 6) == "allow")
						<li> <a href="{{ url('myleaveapplications') }}"><i class="bx bx-right-arrow-alt"></i>My Leave Applications</a>
						</li>
						@endif
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-repeat"></i>
						</div>
						<div class="menu-title">Payroll</div>
					</a>
					<ul>
					    @if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 13, 2) == "allow")
						<li> <a href="{{ url('basicpay') }}"><i class="bx bx-right-arrow-alt"></i>Basic Pay</a>
						</li>
						@endif
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 13, 2) == "allow")
						<li> <a href="{{ url('paye') }}"><i class="bx bx-right-arrow-alt"></i>PAYE Calculation</a>
						</li>
						@endif
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 13, 2) == "allow")
						<li> <a href="{{ url('allowances') }}"><i class="bx bx-right-arrow-alt"></i>Allowances</a>
						</li>
						@endif
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 13, 6) == "allow")
						<li> <a href="{{ url('alloweddeductions') }}"><i class="bx bx-right-arrow-alt"></i>Allowed Deductions</a>
						</li>
						@endif
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 14, 2) == "allow")
						<li> <a href="{{ url('bonuses') }}"><i class="bx bx-right-arrow-alt"></i>Bonuses</a>
						</li>
						@endif
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 13, 2) == "allow")
						<li> <a href="{{ url('deductions') }}"><i class="bx bx-right-arrow-alt"></i>Staff Deductions</a>
						</li>
						@endif
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 13, 6) == "allow")
						<li> <a href="{{ url('payroll') }}"><i class="bx bx-right-arrow-alt"></i>Generate Payroll</a>
						</li>
						@endif
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 14, 2) == "allow")
						<li> <a href="{{ url('allpayroll') }}"><i class="bx bx-right-arrow-alt"></i>Payroll History</a>
						</li>
						@endif
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 14, 2) == "allow")
						<li> <a href="{{ url('comparepayroll') }}"><i class="bx bx-right-arrow-alt"></i>Compare Payslips</a>
						</li>
						@endif
						<!--<li> <a href="{{ url('banks') }}"><i class="bx bx-right-arrow-alt"></i>Banks</a></li>
						--<li> <a href="error-blank-page.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Blank Page</a>
						</li>-->
					</ul>
				</li>
				<!--<li>
					<a href="charts-chartjs.html">
						<div class="parent-icon"><i class="bx bx-user-circle"></i>
						</div>
						
						<div class="menu-title">
						<form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="btn btn-danger btn-sm" href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" style="color: #fff"></i>
                                            {{ __('Log Out') }}
                                        </a>
                                    </form>
						</div>
					</a>
				</li>-->
					<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bxs-bus' ></i>
						</div>
						<div class="menu-title">Logistics</div>
					</a>
					<ul>
						<li> <a href="{{ url('alllogistics') }}"><i class="bx bx-right-arrow-alt"></i>Logistics</a>
						</li>
						<li> <a href="{{ url('logisticcreate') }}"><i class="bx bx-right-arrow-alt"></i>Create Request</a>
						</li>
					    <li> <a href="{{ url('logisticrequest') }}"><i class="bx bx-right-arrow-alt"></i>Requests</a>
						</li>
						
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bxs-store-alt'></i>
						</div>
						<div class="menu-title">Procuremet</div>
					</a>
					<ul>
						<li> <a href="{{ url('procurementcreate') }}"><i class="bx bx-right-arrow-alt"></i>New Procurement</a>
						</li>
						<li> <a href="{{ url('myprocurements') }}"><i class="bx bx-right-arrow-alt"></i>My Procurements </a>
						</li>
					    <li> <a href="{{ url('procurement') }}"><i class="bx bx-right-arrow-alt"></i>View All Procurement</a>
						</li>
						
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bxs-box' ></i>
						</div>
						<div class="menu-title">Stocks</div>
					</a>
					<ul>
						<li> <a href="{{ url('createstock') }}"><i class="bx bx-right-arrow-alt"></i>New Stock</a>

						</li>
						<li> <a href="{{ url('stock') }}"><i class="bx bx-right-arrow-alt"></i>View All Stocks</a>

	
						
						</li>
					
					    
						</li>
						
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bxs-box' ></i>
						</div>
						<div class="menu-title">Stock Request</div>
					</a>
					<ul>

				
						<li> <a href="{{ url('stockrequest') }}"><i class="bx bx-right-arrow-alt"></i>All Stock Request</a>
						<li> <a href="{{ url('stockrequestlisttreat') }}"><i class="bx bx-right-arrow-alt"></i>Treat Stock Request</a>

						<li> <a href="{{ url('mystockrequest') }}"><i class="bx bx-right-arrow-alt"></i>View My Requests</a>
						</li>
						<li> <a href="{{ url('stockrequestcreate') }}"><i class="bx bx-right-arrow-alt"></i>Make  Request</a>
						</li>
						
						</li>
					
					    
						</li>
						
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bxs-group'></i>
						</div>
						<div class="menu-title">Categories</div>
					</a>
					<ul>
						 <li> <a href="{{ url('categorycreate') }}"><i class="bx bx-right-arrow-alt"></i>New Category</a>
						</li>
						<li> <a href="{{ url('categories') }}"><i class="bx bx-right-arrow-alt"></i>View All Category</a>
						</li>
					
					   
						
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bxs-group'></i>
						</div>
						<div class="menu-title">Budget</div>
					</a>
					<ul>
						 <li> 
							<a href="{{url('budgetcreate')}}"><i class="bx bx-right-arrow-alt"></i>New Budget Request</a>
						</li>
						<li> 
							<a href="{{url('budgets')}}"><i class="bx bx-right-arrow-alt"></i>All Budget Request</a>
						</li>
					    <li>
							 <a href="{{ url('mybudgets') }}"><i class="bx bx-right-arrow-alt"></i>My Budget Request</a>
						</li>
					   
						
					</ul>
				</li>
					<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bxs-group'></i>
						</div>
						<div class="menu-title">Trainings</div>
					</a>
					<ul>
						 <li> 
							<a href="{{url('trainingcreate')}}"><i class="bx bx-right-arrow-alt"></i>New Training Request</a>
						</li>
						<li> 
							<a href="{{url('trainings')}}"><i class="bx bx-right-arrow-alt"></i>All Training Request</a>
						</li>
					    <li>
							 <a href="{{ url('mytrainings') }}"><i class="bx bx-right-arrow-alt"></i>My Training Request</a>
						</li>
					   
						
					</ul>
				</li>
				<li>
					<a href="{{ url('individualpayroll') }}">
						<div class="parent-icon"> <i class="bx bx-video-recording"></i>
						</div>
						<div class="menu-title">My Payslip</div>
					</a>
				</li>

				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-repeat"></i>
						</div>
						<div class="menu-title">Leave Manager</div>
					</a>
					<ul>
					    @if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 13, 2) == "allow")
						<li> <a href="{{ url('leavetypes') }}"><i class="bx bx-right-arrow-alt"></i>Leave Types</a>
						</li>
						@endif
						@if(app\Http\Controllers\Controller::checkrole(Auth::user()->role, 13, 6) == "allow")
						<li> <a href="{{ url('allleaveapplications') }}"><i class="bx bx-right-arrow-alt"></i>Leave Applications</a>
						</li>
						@endif
					</ul>
				</li>

				
			</ul>
			<!--end navigation-->
			
		</div>
		<!--end sidebar wrapper -->