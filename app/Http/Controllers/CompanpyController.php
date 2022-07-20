<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CompanpyController extends Controller
{

    public function loginCompany(){
        return view('backend.company.loginCompany');
    }
    public function companyList()
    {
        $company = User::orderBy('id', 'DESC')->get();
        return view('backend.company.company', compact('company'));
    }
    public function companyDetails($id){
        $companies = Company::where('company_id',$id)->first();
        return response()->json($companies);
    }
   
    public function companyAdd(Request $request)
    {
        $validateData = $request->validate([

            'company_name' => 'required',
            

        ]);
        $public_key=rand(10000000,99999999);
        $private_key=uniqid();

        $company = new User();
        $company->company_name = $request->company_name;
        $company->public_key=$public_key;
        $company->private_key=$private_key;
        $company->role=1;
        $company->save();

        return redirect()->back()->with('success', 'Data Inserted Successful');
    }


    public function companyEdit($id)
    {

        $company = User::orderBy('id', 'DESC')->get();
        $editData = User::findOrFail($id);
        return view('backend.company.company', compact('company', 'editData'));
    }

    public function companyUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'company_name' => 'required',
        ]);

        $company = User::findOrFail($id);
    

       
        $public_key=rand(10000000,99999999);
        $private_key=uniqid();

     
        $company->company_name = $request->company_name;
        $company->public_key=$public_key;
        $company->private_key=$private_key;
        $company->role=1;
     
        $company->save();

        return redirect()->route('company-List')->with('success', 'Data updated Successful');
    
}
public function setttingConpany(){
    $public=Auth::user()->public_key;
    $role=Auth::user()->role;
    if($role==1){
        $companies=User::where('public_key',$public)->get();
    }else{
        $companies=User::orderBy('id','DESC')->get();
    }

    return view('backend.company.setting',compact('companies'));
}
public function setsetttingCompany(Request $request){

    $validateData = $request->validate([
        'description' => 'required',

        'company_logo' => 'required',


    ]);
    

    $logoimage = $request->file('company_logo');

    if ($logoimage) {
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($logoimage->getClientOriginalExtension());
        $img_name = $name_gen . "." . $img_ext;
        $up_location = 'company_logo/';
        $last_img = $up_location . $img_name;
        $logoimage->move($up_location, $img_name);
        $logo=new Company();


        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        if($role==1){
         $company_name=Auth::user()->company_name;
        }else{
            $company_names=DB::table('users')->select('company_name')->where('public_key',$request->company_id)->first();
            $company_name=$company_names->company_name;
            
        }
        

        
        $logo->description = $request->description;
        $logo->company_logo=$last_img;
        $logo->company_name=$company_name;
       
        if($role==0){
            $logo->company_id=$request->company_id;
        }else{
            $logo->company_id=$public;
        }
       
        
        $logo->save();

        return redirect()->back()->with('success', 'Data Inserted Successful');

}
 
}

public function companyProfile(){
    $public=Auth::user()->public_key;
    $role=Auth::user()->role;
    if($role==1){
        $companies=Company::where('company_id',$public)->first();
        $oderDetails=DB::table('foodorders')->where('company_id',$public)->where('price_status','1')->get();
        $oderDetailsMonth=DB::table('foodorders')->where('company_id',$public)->where('price_status','1')->whereMonth('created_at', date('m'))->get();
        $oderDetailsYear=DB::table('foodorders')->where('company_id',$public)->where('price_status','1')->whereYear('created_at', date('Y'))->get();

        $oderDetailsWeek=DB::table('foodorders')->where('company_id',$public)->where('price_status','1')->whereBetween('created_at', 
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
    )->get();
    return view('backend.company.companyProfile',compact('companies','oderDetails','oderDetailsMonth','oderDetailsWeek','oderDetailsYear'));
    }else{
        $companies=Company::get();
        return view('backend.company.companyAdmin',compact('companies'));
    }
    
}

public function companyProfileDetails($id){
    $company=Company::findOrfail($id);
    $public=$company->company_id;

    $companies=Company::where('company_id',$public)->first();
    $oderDetails=DB::table('foodorders')->where('company_id',$public)->where('price_status','1')->get();
    $oderDetailsMonth=DB::table('foodorders')->where('company_id',$public)->where('price_status','1')->whereMonth('created_at', date('m'))->get();
    $oderDetailsYear=DB::table('foodorders')->where('company_id',$public)->where('price_status','1')->whereYear('created_at', date('Y'))->get();

    $oderDetailsWeek=DB::table('foodorders')->where('company_id',$public)->where('price_status','1')->whereBetween('created_at', 
    [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

    return view('backend.company.companyProfilSingle',compact('companies','oderDetails','oderDetailsMonth','oderDetailsWeek','oderDetailsYear'));
        
}

}