<?php

namespace App\Http\Controllers;

use App\Models\waiter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WaiterController extends Controller
{
    public function waiterList()
    {

        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        if($role==1){
            $waiter = waiter::where('company_id',$public)->get();
            $companies=User::where('public_key',$public)->get();
            $waiterCom=DB::table('waiters')
            ->join('users','waiters.company_id','users.public_key')
            ->select('users.company_name','waiters.*')
            ->where('waiters.company_id',$public)
            ->orderBy('waiters.id','DESC')->get();
            

        }else{
        $waiter = waiter::orderBy('id', 'DESC')->get();
        $companies=User::orderBy('id','DESC')->get();
        $waiterCom=DB::table('waiters')
        ->join('users','waiters.company_id','users.public_key')
        ->select('users.company_name','waiters.*')
        ->orderBy('waiters.id','DESC')->get();

        }
        
        return view('backend.waiter.waiter', compact('waiter','companies','waiterCom'));
    }
    public function appWaiterList($id)
    {

        $waiters = waiter::orderBy('id', 'DESC')->where('company_id',$id)->get();
        return response()->json($waiters);
    }

    public function waiterAdd(Request $request)
    {
        $validateData = $request->validate([

            'waiter_name' => 'required',
        ]);
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;

        $waiter = new waiter();
        $waiter->waiter_name = $request->waiter_name;
        $waiter->waiter_date = date('Y-m-d', strtotime($request->waiter_date));
        if($role==0){
            $waiter->company_id=$request->company_id;
        }else{
            $waiter->company_id=$public;
        }
       
        
        $waiter->save();

        return redirect()->back()->with('success', 'Data Inserted Successful');
    }

    public function waiterEdit($id)
    {

        $waiter = waiter::orderBy('id', 'DESC')->get();
        $editData = waiter::findOrFail($id);
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        if($role==1){
            $companies=User::where('public_key',$public)->get();
           
           }else{
            $companies=User::orderBy('id', 'DESC')->get();
          
           }
        $waiterCom=[];
        return view('backend.waiter.waiter', compact('waiter', 'editData','companies','waiterCom'));
    }

    public function waiterUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'waiter_name' => 'required',
        ]);
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        $waiter = waiter::findOrFail($id);
        $waiter->waiter_name = $request->waiter_name;
        $waiter->waiter_date = date('Y-m-d', strtotime($request->waiter_date));
        if($role==0){
            $waiter->company_id=$request->company_id;
        }else{
            $waiter->company_id=$public;
        }
        $waiter->save();

        return redirect()->route('waiter-List')->with('success', 'Data updated Successful');
    }
}
