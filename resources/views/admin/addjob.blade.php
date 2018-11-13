@extends('layouts/main') @section('pageSpecificCss')
<link type="text/css" rel="stylesheet" href="{{asset('plugins/bower_components/datatables/jquery.dataTables.min.css')}}"
/>
<link type="text/css" rel="stylesheet" href="{{asset('plugins/bower_components/datatables/buttons.dataTables.min.css')}}"
/>
<link type="text/css" rel="stylesheet" href="{{asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}"
/>
<link type="text/css" rel="stylesheet" href="{{asset('plugins/bower_components/custom-select/custom-select.min.css')}}" /> {{--
<link type="text/css" rel="stylesheet" href="{{asset('plugins/bower_components/switchery/dist/switchery.min.css')}}" /> --}}
<link type="text/css" rel="stylesheet" href="{{asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')}}" />
<link type="text/css" rel="stylesheet" href="{{asset('plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css')}}" />
<style type="text/css">
	<style type="text/css">
		.nav-pills {
			background: #4c5667 !important;
		}
		.nav-link.active {
			background: #4c5667 !important;
		}
		.nav-pills>li.active>a,
		.nav-pills>li.active>a:focus,
		.nav-pills>li.active>a:hover {
			background: #4c5667 !important;
			color: #ffffff !important;
		}
		.disabled-color {
			color: #90989c !important;
		}
		.bootstrap-select .dropdown-toggle:focus {
			outline: 0px auto -webkit-focus-ring-color!important;
		}
		.dropdown_select .dropdown-toggle::after {
			display: inline-block;
			position: relative;
			right: 20px;
		}
		.bootstrap-select.btn-group .dropdown-toggle .filter-option {
			padding-right: 15px;
			text-overflow: ellipsis;
		}
		.previous-href{
			background: #e4e7ea !important;
			border: 1px solid #e4e7ea !important;
			padding: 7px 5px !important;
			font-size: 13px !important;
			padding-bottom: 8px !important;
			font-weight: 100 !important;
		}
		.btn-default {
			background: #ffffff !important;
			border: 1px solid #e4e7ea;
			padding: 10px 5px !important;
			font-size: 13px !important;
			padding-bottom: 8px !important;
			font-weight: 100 !important;
		}
		.btn-default:hover {
			background: #e4e7ea !important;
		}
	</style>
	@stop @section('content')
	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Jobs</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info">
					<div class="panel-wrapper collapse in" aria-expanded="true">
						<!--header-->
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-4 m-t-15 m-l-15">
								<a class="previous-href btn btn-circle" href="{{route('activejobs')}}" title="Previous">
									<i class="ti-arrow-left"></i>
								</a>
							</div>
						</div>
						<!--/header-->
						<div class="panel-body">
							<ul class="nav nav-pills m-b-30">
								<li class="active nav-item">
									<a href="#tab1" class="nav-link" data-toggle="tab" aria-expanded="true">JOB PROFILE</a>
								</li>
							</ul>
							<div class="form-body form-material">
								<div class="tab-content br-n pn">
									<!--tab1-->
									<div id="tab1" class="tab-pane active">
										<form id="formAddJob" method="post">
											{{ csrf_field() }} {{--
											<input type="hidden" name="hiddenMail" id="hiddenMail" value="{{$accountDetail->email or ''}}"> --}} {{--
											<input type="show" name="hiddenStatus" id="hiddenStatus" value="{{$new_account or ''}}"> --}}
											<input type="hidden" name="hiddenJobId" id="hiddenJobId" value="{{$jobDetails->job_id or ''}}">
											<input type="hidden" name="hiddenisclone" id="hiddenisclone" value="{{$cloneflag or ''}}">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>JOB TITLE *</b>
														</label>
														<input type="text" name="jobTitle" id="jobTitle" value="{{$jobDetails->job_title or ''}}" class="form-control" placeholder="Job Title">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>JOB ACTIVE/INACTIVE</b>
														</label>
														<select id="jobStatus" name="jobStatus" class="form-control ">
															<option value="1" @if(isset($jobDetails->is_active) && $jobDetails->is_active == '1') {{ "selected='selected'" }} @endif>ACTIVE</option>
															<option value="0" @if(isset($jobDetails->is_active) && $jobDetails->is_active == '0') {{ "selected='selected'" }} @endif>INACTIVE</option>
														</select>
													</div>
												</div>
												<!-- <div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>JOB ID</b>
														</label>
														<br>
														<span class="disabled-color" id="jobId">{{$jobDetails->job_id or '' }}</span>
													</div>
												</div> -->
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>JOB STATUS</b>
														</label>
														<select id="jobType" name="jobType" class="form-control ">
															@foreach($jobTypeDetails as $jobType)
															<option value="{{ $jobType->job_status_id }}" @if(isset($jobDetails->job_status_id) && $jobDetails->job_status_id == $jobType->job_status_id) {{"selected='selected'"}} @endif>{{ $jobType->job_status_name }}</option>

															@endforeach
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>ADDRESS 1 *</b>
														</label>
														<input type="text" name="locationAddress" id="locationAddress" value="{{$jobDetails->address_1 or ''}}" class="form-control"
														placeholder="Address line 1">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>ADDRESS 2</b>
														</label>
														<br>
														<input type="text" name="subAddress" id="subAddress" value="{{$jobDetails->address_2 or ''}}" class="form-control" placeholder="Address line 2">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>APARTMENT NUMBER</b>
														</label>
														<br>
														<input type="text" name="apartmentNo" id="apartmentNo" value="{{$jobDetails->apartment_number or ''}}" class="form-control"
														placeholder="Apartment Number">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>CITY</b>
														</label>
														<input type="text" name="city" id="city" value="{{$jobDetails->city or ''}}" class="form-control" placeholder="Enter City">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>STATE</b>
														</label>
														<input type="text" name="state" id="state" value="{{$jobDetails->state or ''}}" class="form-control" placeholder="Enter State">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>ZIPCODE</b>
														</label>
														<input type="text" placeholder="Enter Zipcode" name="zipcode" id="zipcode" value="{{$jobDetails->zipcode or ''}}" class="form-control">
													</div>
												</div>
											</div>
											<div class="row">

												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>JOB COMPANY NAME *</b>
														</label>
														<select id="jobCompanyName" name="jobCompanyName" class="form-control select2">
															<option value="">-- Select Company --</option>
															@foreach($comapnyList as $company)
															<option value="{{ $company->company_id }}" @if(isset($jobDetails->company_id) && $jobDetails->company_id == $company->company_id) {{"selected='selected'"}} @endif>{{ $company->name }}</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group dropdown_select" style="overflow: visible!important;">
														<label class="control-label"><b>COMPANY CLIENTS *</b></label>
														<select data-size="5" id="comapnyClients" name="comapnyClients" class="form-control selectpicker" multiple data-actions-box="true"  data-style="form-control">
															@if(isset($companyClientList) && sizeof($companyClientList) > 0)
															@foreach($companyClientList as $client)
															<option value="{{ $client->id }}"
																@if(isset($jobDetails->company_clients_id) && sizeof($jobDetails->company_clients_id) > 0)
																@foreach($jobDetails->company_clients_id as $single_client)
																@if($single_client == $client->id) {{"selected='selected'"}}@endif @endforeach @endif>{{ $client->client_name }}
															</option>
															@endforeach
															@endif
														</select>
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label"><b>SALES PERSON</b></label>
														<select id="salesEmployee" name="salesEmployee" class="form-control ">
															<option value="">-- Select Sales Person --</option>
															@foreach($salesemployeelist as $semployee)
															<option value="{{ $semployee->id }}"
																@if(sizeof($jobDetails->sales_employee_id) > 0)
																@foreach($jobDetails->sales_employee_id as $single_id)
																@if($single_id == $semployee->id) {{"selected='selected'"}}@endif @endforeach @endif
																>
																{{ $semployee->employee_name }}
															</option>
															@endforeach
														</select>
													</div>

												</div>
												
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>JOB START DATE *</b>
														</label>
														<input type="text" name="jobStartDate" id="jobStartDate" class="form-control complex-colorpicker" placeholder="mm/dd/yyyy"
														maxlength="10" value="{{ $jobDetails->start_date or '' }}">
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>EXPECTED COMPLETION DATE *</b>
														</label>
														<input type="text" name="jobEndDate" id="jobEndDate" class="form-control complex-colorpicker" placeholder="mm/dd/yyyy" maxlength="10"
														value="{{ $jobDetails->end_date or '' }}">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>PLUMBING INSTALLATION DATE</b>
														</label>
														<input type="text" name="plumbingInstallationDate" id="plumbingInstallationDate" class="form-control complex-colorpicker"
														placeholder="mm/dd/yyyy" maxlength="10" value="{{ $jobDetails->plumbing_installation_date or '' }}">
													</div>
												</div>
												

												
											</div>
											<div class="row">

												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>DELIVERY DATE AND TIME</b>
														</label>
														<div class="row">
															<div class="col-md-4">
																<input type="text" name="deliveryDate" id="deliveryDate" class="form-control complex-colorpicker" placeholder="mm/dd/yyyy"
																maxlength="10" value="{{ $jobDetails->delivery_date or '' }}">
															</div>
															<div class="col-md-8">
																<div class="input-group clockpicker " data-placement="top">
																	<input type="text" id="deliveryTime" name="deliveryTime" class="form-control" placeholder="hh:mm" value="{{ $jobDetails->delivery_time or '' }}">
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>JOB SUPER NAME *</b>
														</label>
														<input type="text" name="jobSuperName" id="jobSuperName" value="{{$jobDetails->super_name or ''}}" class="form-control" placeholder="Job Super Name">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>JOB SUPER PHONE NUMBER *</b>
														</label>
														<input type="text" placeholder="(xxx) xxx-xxxx" name="superPhoneNumber" id="superPhoneNumber" value="{{$jobDetails->super_phone_number or ''}}"
														class="form-control">
													</div>
												</div>
												
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>JOB CONTRACTOR NAME</b>
														</label>
														<input type="text" style="text-transform:uppercase" name="jobContractorName" id="jobContractorName" value="{{$jobDetails->contractor_name or ''}}"
														class="form-control" placeholder="Enter Job Contractor Name">
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>CONTRACTOR EMAIL ADDRESS</b>
														</label>
														<input style="text-transform: lowercase;" type="email" name="contractorEmail" id="contractorEmail" value="{{$jobDetails->contractor_email or ''}}"
														class="form-control" placeholder="Enter Contractor Email">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>CONTRACTOR PHONE NUMBER</b>
														</label>
														<input type="text" placeholder="(xxx) xxx-xxxx" name="contractorPhoneNumber" id="contractorPhoneNumber" value="{{$jobDetails->contractor_phone_number or ''}}"
														class="form-control">
													</div>
												</div>


											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group dropdown_select" style="overflow: visible!important;">
														<label class="control-label"><b>WORKING EMPLOYEES</b></label>
														<select data-size="5" id="workingEmployee" name="workingEmployee" class="form-control selectpicker" multiple data-actions-box="true"  data-style="form-control">
															@foreach($employeeList as $employee)
															<option value="{{ $employee->id }}"
																@if(isset($jobDetails->working_employee_id) && sizeof($jobDetails->working_employee_id) > 0)
																@foreach($jobDetails->working_employee_id as $single_id)
																@if($single_id == $employee->id) {{"selected='selected'"}}@endif @endforeach @endif
																>{{ $employee->employee_name }}
															</option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>INSTALLATION</b>
														</label>
														<select id="installationSelect" name="installationSelect" class="form-control ">
															<option value="1" @if(isset($jobDetails->is_select_installation) && $jobDetails->is_select_installation == '1') {{ "selected='selected'" }} @endif>Awaiting Install</option>

															<option value="2" @if(isset($jobDetails->is_select_installation) && $jobDetails->is_select_installation == '2') {{ "selected='selected'" }} @endif>Awaiting Approval</option>
															
															<option value="3" @if(isset($jobDetails->is_select_installation) && $jobDetails->is_select_installation == '3') {{ "selected='selected'" }} @endif>Scheduled</option>
														</select>
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>STONE INSTALLATION</b>
														</label>
														<select id="stoneInstallationSelect" name="stoneInstallationSelect" class="form-control ">
															
															<option value="1" @if(isset($jobDetails->is_select_stone_installation) && $jobDetails->is_select_stone_installation == '1') {{ "selected='selected'" }} @endif>Awaiting Approval</option>
															<option value="2" @if(isset($jobDetails->is_select_stone_installation) && $jobDetails->is_select_stone_installation == '2') {{ "selected='selected'" }} @endif>Scheduled</option>
														</select>
													</div>
												</div>

											</div>
											<div class="row">

												<div class="col-md-4 installationRow">
													<div class="form-group">
														<label class="control-label">
															<b>INSTALLATION DATE AND TIME</b>
														</label>
														<div class="row">
															<div class="col-md-4">
																<input type="text" name="installationDate" id="installationDate" class="form-control complex-colorpicker" placeholder="mm/dd/yyyy"
																maxlength="10" value="{{ $jobDetails->installation_date or '' }}">
															</div>
															<div class="col-md-8">
																<div class="input-group clockpicker " data-placement="top">
																	<input type="text" id="installationTime" name="installationTime" class="form-control" placeholder="hh:mm" value="{{$jobDetails->installation_time or ''}}">
																</div>
															</div>
														</div>
													</div>
												</div>
												
												<div class="col-md-4 installationRow">
													<div class="form-group dropdown_select" style="overflow: visible!important;">
														<label class="control-label"><b>INSTALLATION EMPLOYEES</b></label>
														<select data-size="5" id="installationEmployees" name="installationEmployees" class="form-control selectpicker" multiple data-actions-box="true"  data-style="form-control">
															@foreach($installEmployeeList as $installer)
															<option value="{{ $installer->id }}"
																@if(isset($jobDetails->installation_employee_id) && sizeof($jobDetails->installation_employee_id) > 0)
																@foreach($jobDetails->installation_employee_id as $single_id)
																@if($single_id == $installer->id) {{"selected='selected'"}}@endif @endforeach @endif>{{ $installer->employee_name }}
															</option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="col-md-4 stoneInstallationRow">
													<div class="form-group">
														<label class="control-label">
															<b>STONE INSTALLATION DATE AND TIME</b>
														</label>
														<div class="row">
															<div class="col-md-4">
																<input type="text" name="stoneInstallationDate" id="stoneInstallationDate" class="form-control complex-colorpicker" placeholder="mm/dd/yyyy"
																maxlength="10" value="{{ $jobDetails->stone_installation_date or '' }}">
															</div>
															<div class="col-md-8">
																<div class="input-group clockpicker " data-placement="top">
																	<input type="text" id="stoneInstallationTime" name="stoneInstallationTime" class="form-control" placeholder="hh:mm" value="{{ $jobDetails->stone_installation_time or '' }}">
																</div>
															</div>
														</div>
													</div>
												</div>

											</div>
											<div class="row">

												<div class="col-md-4 stoneInstallationRow">
													<div class="form-group dropdown_select" style="overflow: visible!important;">
														<label class="control-label"><b>STONE INSTALLATION EMPLOYEES</b></label>
														<select data-size="5" id="stoneInstallationEmployees" name="stoneInstallationEmployees" class="form-control selectpicker" multiple data-actions-box="true"  data-style="form-control">
															@foreach($stoneEmployeeList as $stone)
															<option value="{{ $stone->id }}"
																@if(isset($jobDetails->stone_installation_employee_id) && sizeof($jobDetails->stone_installation_employee_id) > 0)
																@foreach($jobDetails->stone_installation_employee_id as $single_id)
																@if($single_id == $stone->id) {{"selected='selected'"}}@endif @endforeach @endif>{{ $stone->employee_name }}
															</option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">
															<b>DELIVERY  INSTALLATION</b>
														</label>
														<select id="deliveryInstallationSelect" name="deliveryInstallationSelect" class="form-control ">
															<option value="1" @if(isset($jobDetails->is_select_delivery_installation) && $jobDetails->is_select_delivery_installation == '1') {{ "selected='selected'" }} @endif>Awaiting Materia</option>

															<option value="2" @if(isset($jobDetails->is_select_delivery_installation) && $jobDetails->is_select_delivery_installation == '2') {{ "selected='selected'" }} @endif>Awaiting Approval</option>

															<option value="3" @if(isset($jobDetails->is_select_delivery_installation) && $jobDetails->is_select_delivery_installation == '3') {{ "selected='selected'" }} @endif>Received</option>

															<option value="4" @if(isset($jobDetails->is_select_delivery_installation) && $jobDetails->is_select_delivery_installation == '4') {{ "selected='selected'" }} @endif>Scheduled</option>
														</select>
													</div>
												</div>

												<div class="col-md-4 deliveryInstallationRow">
													<div class="form-group">
														<label class="control-label">
															<b>DELIVERY INSTALLATION DATE AND TIME</b>
														</label>
														<div class="row">
															<div class="col-md-4">
																<input type="text" name="deliveryInstallationDate" id="deliveryInstallationDate" class="form-control complex-colorpicker" placeholder="mm/dd/yyyy"
																maxlength="10" value="{{ $jobDetails->delivery_installation_date or '' }}">
															</div>
															<div class="col-md-8">
																<div class="input-group clockpicker " data-placement="top">
																	<input type="text" id="deliveryInstallationTime" name="deliveryInstallationTime" class="form-control" placeholder="hh:mm" value="{{ $jobDetails->delivery_installation_time or '' }}">
																</div>
															</div>
														</div>
													</div>
												</div>


											</div>

											<div class="row">

												<div class="col-md-4 deliveryInstallationRow">
													<div class="form-group dropdown_select" style="overflow: visible!important;">
														<label class="control-label"><b>DELIVERY INSTALLATION EMPLOYEES</b></label>
														<select data-size="5" id="deliveryInstallationEmployees" name="deliveryInstallationEmployees" class="form-control selectpicker" multiple data-actions-box="true"  data-style="form-control">
															@foreach($deliveryEmployeeList as $delivery)
															<option value="{{ $delivery->id }}"
																@if(isset($jobDetails->delivery_installation_employee_id) && sizeof($jobDetails->delivery_installation_employee_id) > 0)
																@foreach($jobDetails->delivery_installation_employee_id as $single_id)
																@if($single_id == $delivery->id) {{"selected='selected'"}}@endif @endforeach @endif>{{ $delivery->employee_name }}
															</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
											<div class="form-group text-left p-t-md">
												@if(!isset($jobDetails->job_id) || isset($cloneflag))
												<button type="submit" class="btn btn-success jobformsubmit">CREATE JOB</button>
												@endif @if(isset($jobDetails->job_id) && !isset($cloneflag))
												<button type="submit" class="btn btn-info jobformsubmit">UPDATE</button>
												@endif &nbsp; &nbsp;
												<button id="resetPermission" type="button" class="btn btn-danger">CANCEL</button>
											</div>
										</form>
									</div>
									<!--/.tab1-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@stop @section('pageSpecificJs')
	<script type="text/javascript" src="{{asset('plugins/bower_components/datatables/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/bower_components/datatables/dataTables.buttons.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/bower_components/datatables/buttons.flash.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/bower_components/datatables/jszip.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/bower_components/datatables/pdfmake.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/bower_components/datatables/vfs_fonts.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/bower_components/datatables/buttons.html5.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/bower_components/datatables/buttons.print.min.js')}}"></script>

	<script type="text/javascript" src="{{asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{ asset('scripts/jquery.maskedinput.min.js') }}"></script>
	<script type="text/javascript" src="{{asset('plugins/bower_components/custom-select/custom-select.min.js')}}"></script>
	<script src="{{ asset('scripts/company-location.js') }}"></script>
	<script type="text/javascript" src="{{asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js')}}"></script>
	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$(document).ready(function () {

			if (typeof ($('#jobContractorName').val()) != "undefined" && $('#jobContractorName').val() !== null)
				$('#jobContractorName').val($('#jobContractorName').val().toUpperCase());
			if (typeof ($('#clientLastName').val()) != "undefined" && $('#clientLastName').val() !== null)
				$('#clientLastName').val($('#clientLastName').val().toUpperCase());
			if (typeof ($('#contractorEmail').val()) != "undefined" && $('#contractorEmail').val() !== null)
				$('#contractorEmail').val($('#contractorEmail').val().toLowerCase());

			$("#jobCompanyName").change(function(){
				var company_id = $(this).val();
				$.ajax({
					url: '{{ route('getcompanyclients') }}',
					data: {company_id:company_id},
					type: 'post',
					dataType: 'json',
					success:function(response){
						if(response.key == 1)
						{
							var len = response.clients_data.length;
							$("#comapnyClients").empty();
							for( var i = 0; i<len; i++){
								var id = response.clients_data[i]['id'];
								var name = response.clients_data[i]['client_name'];
								$("#comapnyClients").append("<option value='"+id+"' >"+name+"</option>");
							}
						}
						else
						{
							$("#comapnyClients").empty();
							$('#formAddJob').bootstrapValidator('revalidateField', 'comapnyClients');
						}
						$('#comapnyClients').selectpicker('refresh');
					}
				});
			});

			/*installation status*/
			var installationStatus = $("#installationSelect").val();
			(installationStatus == 3) ? $('.installationRow').slideDown() : $('.installationRow').slideUp();

			/* stone installation status*/
			var stoneInstallationStatus = $("#stoneInstallationSelect").val();
			(stoneInstallationStatus == 2) ? $('.stoneInstallationRow').slideDown() : $('.stoneInstallationRow').slideUp();

			var deliveryInstallationStatus = $("#deliveryInstallationSelect").val();
			(deliveryInstallationStatus == 4) ? $('.deliveryInstallationRow').slideDown() : $('.deliveryInstallationRow').slideUp();

			$('#resetPermission').click(function () {
				location.reload();
			});
		});

$("#installationSelect").change(function(){
	var installationStatus = $(this).val();
	(installationStatus == 3) ? $('.installationRow').slideDown() : $('.installationRow').slideUp();
	$('#formAddJob').data('bootstrapValidator')
	.enableFieldValidators('installationDate', false)
	.enableFieldValidators('installationTime', false)
	.enableFieldValidators('installationEmployees', false);
});

$("#stoneInstallationSelect").change(function(){
	var stoneInstallationStatus = $(this).val();
	(stoneInstallationStatus == 2) ? $('.stoneInstallationRow').slideDown() : $('.stoneInstallationRow').slideUp();
	$('#formAddJob').data('bootstrapValidator')
	.enableFieldValidators('stoneInstallationDate', false)
	.enableFieldValidators('stoneInstallationTime', false)
	.enableFieldValidators('stoneInstallationEmployees', false);
});

$("#deliveryInstallationSelect").change(function(){
	var deliveryInstallationStatus = $(this).val();
	(deliveryInstallationStatus == 4) ? $('.deliveryInstallationRow').slideDown() : $('.deliveryInstallationRow').slideUp();
	$('#formAddJob').data('bootstrapValidator')
	.enableFieldValidators('deliveryInstallationDate', false)
	.enableFieldValidators('deliveryInstallationTime', false)
	.enableFieldValidators('deliveryInstallationEmployees', false);
});

$("#installationTime").change(function(){
	$('#formAddJob').data('bootstrapValidator')
	.enableFieldValidators('installationTime', true);
	$('#formAddJob').bootstrapValidator('revalidateField', 'installationTime');
});

$("#installationEmployees").change(function(){
	$('#formAddJob').data('bootstrapValidator')
	.enableFieldValidators('installationEmployees', true);
	$('#formAddJob').bootstrapValidator('revalidateField', 'installationEmployees');
});

$("#stoneInstallationTime").change(function(){
	$('#formAddJob').data('bootstrapValidator')
	.enableFieldValidators('stoneInstallationTime', true);
	$('#formAddJob').bootstrapValidator('revalidateField', 'stoneInstallationTime');
});

$("#stoneInstallationEmployees").change(function(){
	$('#formAddJob').data('bootstrapValidator')
	.enableFieldValidators('stoneInstallationEmployees', true);
	$('#formAddJob').bootstrapValidator('revalidateField', 'stoneInstallationEmployees');
});

$("#deliveryInstallationTime").change(function(){
	$('#formAddJob').data('bootstrapValidator')
	.enableFieldValidators('deliveryInstallationTime', true);
	$('#formAddJob').bootstrapValidator('revalidateField', 'deliveryInstallationTime');
});

$("#deliveryInstallationEmployees").change(function(){
	$('#formAddJob').data('bootstrapValidator')
	.enableFieldValidators('deliveryInstallationEmployees', true);
	$('#formAddJob').bootstrapValidator('revalidateField', 'deliveryInstallationEmployees');
});

/*check revalidation*/
$(".jobformsubmit").click(function(){
	var installationStatus = $("#installationSelect").val();
	var stoneInstallationStatus = $("#stoneInstallationSelect").val();
	var deliveryInstallationStatus = $("#deliveryInstallationSelect").val();
	var installStatus = (installationStatus == 3) ? true : false;
	var StoneInstallStatus = (stoneInstallationStatus == 2) ? true : false;
	var DeliveryInstallStatus = (deliveryInstallationStatus == 4) ? true : false;

	$('#formAddJob').data('bootstrapValidator')
	.enableFieldValidators('installationDate', installStatus)
	.enableFieldValidators('installationTime', installStatus)
	.enableFieldValidators('installationEmployees', installStatus)
	.enableFieldValidators('stoneInstallationDate', StoneInstallStatus)
	.enableFieldValidators('stoneInstallationTime', StoneInstallStatus)
	.enableFieldValidators('stoneInstallationEmployees', StoneInstallStatus)
	.enableFieldValidators('deliveryInstallationDate', DeliveryInstallStatus)
	.enableFieldValidators('deliveryInstallationTime', DeliveryInstallStatus)
	.enableFieldValidators('deliveryInstallationEmployees', DeliveryInstallStatus);
});

/* For select 2*/
$(".select2").select2();
$('.selectpicker').selectpicker();
$('.clockpicker').clockpicker({
	twelvehour: true,
	autoclose: true,
});

$('#formAddJob').on('success.form.bv', function (e) {
	e.preventDefault();
	$('#loader').show();
	var hidden_job_id = $('#hiddenJobId').val();
	var hiddenisclone = $('#hiddenisclone').val();
	var job_title = $('#jobTitle').val();
	var job_status = $('#jobStatus').val();
	var job_status_id = $('#jobType').val();
	var address_1 = $('#locationAddress').val();
	var address_2 = $('#subAddress').val();
	var apartment_no = $('#apartmentNo').val();
	var city = $('#city').val();
	var state = $('#state').val();
	var zipcode = $('#zipcode').val();
	var job_start_date = $('#jobStartDate').val();
	var job_end_date = $('#jobEndDate').val();
	var plumbing_installation_date = $('#plumbingInstallationDate').val();
	var delivery_date = $('#deliveryDate').val();
	var delivery_time = $('#deliveryTime').val();
	var job_super_name = $('#jobSuperName').val();
	var super_phone_number = $('#superPhoneNumber').val();
	var job_contractor_name = $('#jobContractorName').val();
	var contractor_email = $('#contractorEmail').val();
	var contractor_phone_number = $('#contractorPhoneNumber').val();
	var job_company_id = $('#jobCompanyName').val();
	var sales_employee_id = $('#salesEmployee').val();
	var comapny_clients_id = $('#comapnyClients').val();
	var working_employee_id = $('#workingEmployee').val();
	var installation_select = $('#installationSelect').val();
	var installation_date = $('#installationDate').val();
	var installation_time = $('#installationTime').val();
	var installation_employees_id = $('#installationEmployees').val();
	var stone_installation_select = $('#stoneInstallationSelect').val();
	var stone_installation_date = $('#stoneInstallationDate').val();
	var stone_installation_time = $('#stoneInstallationTime').val();
	var stone_installation_employees_id = $('#stoneInstallationEmployees').val();
	var delivery_installation_select = $('#deliveryInstallationSelect').val();
	var delivery_installation_date = $('#deliveryInstallationDate').val();
	var delivery_installation_time = $('#deliveryInstallationTime').val();
	var delivery_installation_employees_id = $('#deliveryInstallationEmployees').val();

	$.ajax({
		url: '{{ route('storejob') }}',
		data: {
			hidden_job_id: hidden_job_id,
			hiddenisclone: hiddenisclone,
			job_title: job_title,
			job_status: job_status,
			job_status_id: job_status_id,
			address_1: address_1,
			address_2: address_2,
			apartment_no: apartment_no,
			city: city,
			state: state,
			zipcode: zipcode,
			job_start_date: job_start_date,
			job_end_date: job_end_date,
			plumbing_installation_date: plumbing_installation_date,
			delivery_date: delivery_date,
			delivery_time: delivery_time,
			job_super_name: job_super_name,
			super_phone_number: super_phone_number,
			job_contractor_name: job_contractor_name,
			contractor_email: contractor_email,
			contractor_phone_number: contractor_phone_number,
			job_company_id: job_company_id,
			comapny_clients_id: comapny_clients_id,
			sales_employee_id: sales_employee_id,
			working_employee_id: working_employee_id,
			installation_select: installation_select,
			installation_date: installation_date,
			installation_time: installation_time,
			installation_employees_id: installation_employees_id,
			stone_installation_select: stone_installation_select,
			stone_installation_date: stone_installation_date,
			stone_installation_time: stone_installation_time,
			stone_installation_employees_id: stone_installation_employees_id,
			delivery_installation_select: delivery_installation_select,
			delivery_installation_date: delivery_installation_date,
			delivery_installation_time: delivery_installation_time,
			delivery_installation_employees_id: delivery_installation_employees_id,
		},
		type: 'post',
		dataType: 'json',
		success: function (data) {
			if (data.key == 1) {
				location.href = '{{ route('activejobs') }}';
			} else if(data.key == 2) {
				$('#loader').hide();
				notify('Job has been updated Successfully.', 'blackgloss');
			} else {
				$('#loader').hide();
				notify('Something went wrong.', 'blackgloss');
			}
		}
	});
});

$("#formAccountSetting").on('success.form.bv', function (e) {
	e.preventDefault();
	$("#loader").show();
	var current_password = $("#currentPassword").val();
	var new_password = $('#newPassword').val();
	var retype_password = $('#retypePassword').val();
	var hidden_email = $('#hiddenMail').val();
	if (new_password != retype_password) {
		$("#loader").hide();
		notify('New password and  Retype password is not match. Please try again.', 'blackgloss');
		return;
	}
	$.ajax({
		url: '{{ route('changepassword') }}',
		data: {
			current_password: current_password,
			new_password: new_password,
			hidden_email: hidden_email,
		},
		type: 'post',
		success: function (data) {
			if (data == 1) {
				$('#loader').hide();
				notify('Your password has been reset.', 'blackgloss');
			} else if (data == 2) {
				$('#loader').hide();
				notify('Current password is invalid. Please try again.', 'blackgloss');
			}
		}
	});
});

$('#jobContractorName').keyup(function () {
	this.value = this.value.toUpperCase();
});

$('#contractorEmail').keyup(function () {
	this.value = this.value.toLowerCase();
});

$('#jobStartDate,#jobEndDate,#plumbingInstallationDate,#deliveryDate,#deliveryTime,#installationDate,#installationTime,#stoneInstallationDate,#stoneInstallationTime').attr('readonly', true);

/*prevent form to submit on enter*/
$(document).on("keypress", ":input:not(textarea)", function (event) {
	return event.keyCode != 13;
});

/*Mask phone Number Digits*/
$("#superPhoneNumber,#contractorPhoneNumber").mask("(999) 999 - 9999");

jQuery('#jobStartDate').datepicker({
	autoclose: true,
	todayHighlight: true,
}).on('changeDate', function() {
	$('#jobEndDate').datepicker('setStartDate', new Date($(this).val()))
});

/*Date picker*/
jQuery('#jobEndDate,#plumbingInstallationDate,#deliveryDate,#installationDate,#stoneInstallationDate').datepicker({
	autoclose: true,
	todayHighlight: true,
});

/*Stone installation date*/
$("#stoneInstallationDate").change(function(){
	$('#formAddJob').data('bootstrapValidator')
	.enableFieldValidators('stoneInstallationDate', true);
	$('#formAddJob').bootstrapValidator('revalidateField', 'stoneInstallationDate');
});
/*installation date*/
$("#installationDate").change(function(){
	$('#formAddJob').data('bootstrapValidator')
	.enableFieldValidators('installationDate', true);
	$('#formAddJob').bootstrapValidator('revalidateField', 'installationDate');
});

function changePermission(id) {
	var value = $('#access_' + id).val();
	if (value == 1) {
		$('#access_' + id).val(0);
	} else {
		$('#access_' + id).val(1);
	}
}
</script>
@stop