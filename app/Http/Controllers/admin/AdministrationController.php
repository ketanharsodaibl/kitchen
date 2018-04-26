<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminHomeController;
date_default_timezone_set('UTC');
use DB;
use URL;
use Session;
use Mail;
use Validator;
use App\Company;

class AdministrationController extends Controller
{
	public function index() {
		$client_company = Company::selectRaw('name,phone_number,address_1,email,created_at,id')->where('is_deleted',0)->get();
		return view('admin.clientcompany')->with('clientCompanyList',$client_company);
	}

	public function create() {
		return view('admin.addclientcompany');
	}

	public function store(Request $request) {
		$hidden_companyId = $request->get('hidden_companyId');
		$company_name = $request->get('company_name');
		$company_contactNo = $request->get('company_contactNo');
		$company_email = $request->get('company_email');
		$company_address_1 = $request->get('company_address_1');
		$company_address_2 = $request->get('company_address_2');
		$city = $request->get('city');
		$state = $request->get('state');
		$zipcode = $request->get('zipcode');

		if(!empty($hidden_companyId))
		{
			$getDetail = Company::where('id',$hidden_companyId)->first();
			$getDetail->name = $company_name;
			$getDetail->phone_number = (new AdminHomeController)->replacePhoneNumber($company_contactNo);
			$getDetail->email = $company_email;
			$getDetail->address_1 = $company_address_1;
			$getDetail->address_2 = $company_address_2;
			$getDetail->city = $city;
			$getDetail->state = $state;
			$getDetail->zipcode = $zipcode;
			$getDetail->save();
			$response['key'] = 1;
			Session::put('successMessage', 'Company detail has been updated successfully.');
			echo json_encode($response);
		}
		else
		{
			$objCompany = new Company();
			$objCompany->name = $company_name;
			$objCompany->phone_number = (new AdminHomeController)->replacePhoneNumber($company_contactNo);
			$objCompany->email = $company_email;
			$objCompany->address_1 = $company_address_1;
			$objCompany->address_2 = $company_address_2;
			$objCompany->city = $city;
			$objCompany->state = $state;
			$objCompany->zipcode = $zipcode;
			$objCompany->is_deleted = 0;
			$objCompany->save();
			$response['key'] = 1;
			Session::put('successMessage', 'Company detail has been added successfully.');
			echo json_encode($response);
		}
	}

	public function destroy($company_id)
    {
        Company::where('id',$company_id)->update(['is_deleted' => 1]);
        $msg = 'Company deleted successfully.';
        Session::flash('successMessage',$msg);
        return back();
    }

    public function edit($company_id) {
    	$getCompanyDetail = Company::selectRaw('name,phone_number,address_1,address_2,city,state,zipcode,email,created_at,id')->where('id',$company_id)->get();
    	if(sizeof($getCompanyDetail) > 0)
        {
        	$getCompanyDetail = $getCompanyDetail[0];
        }
        return view('admin.addclientcompany')->with('companyDetail',$getCompanyDetail);
    }
}