<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class TableController extends Controller
{
    public function tableList()
    {
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        if($role==1){
            $companies=User::where('public_key',$public)->get();
            $table = Table::where('company_id',$public)->get();
            $tableCom=DB::table('tables')
            ->join('users','tables.company_id','users.public_key')
            ->select('users.company_name','tables.*')
            ->where('tables.company_id',$public)
            ->orderBy('tables.id','DESC')->get();
            
           
           }else{
            $companies=User::orderBy('id', 'DESC')->get();
            $table = Table::orderBy('id', 'DESC')->get();
            $tableCom=DB::table('tables')
            ->join('users','tables.company_id','users.public_key')
            ->select('users.company_name','tables.*')
            ->orderBy('tables.id','DESC')->get();
          
           }
      
        
       
        return view('backend.table.table', compact('table','companies','tableCom'));
   
    }
    public function appTableList($id){
        $tables = Table::orderBy('id', 'DESC')->where('company_id',$id)->get();
        return response()->json($tables);
    }
    public function tableAdd(Request $request)
    {
        $validateData = $request->validate([

            'table_name' => 'required',
            'table_date' => 'required',

        ]);
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;

        $table = new Table();
        $table->table_name = $request->table_name;
        $table->table_date = date('Y-m-d', strtotime($request->table_date));
        if($role==0){
            $table->company_id=$request->company_id;
        }else{
            $table->company_id=$public;
        }
        $table->save();

        return redirect()->back()->with('success', 'Data Inserted Successful');
    }


    public function tableEdit($id)
    {

        $table = Table::orderBy('id', 'DESC')->get();
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        if($role==1){
            $companies=User::where('public_key',$public)->get();
           
           }else{
            $companies=User::orderBy('id', 'DESC')->get();
          
           }
        $tableCom=[];
        $editData = Table::findOrFail($id);
        return view('backend.table.table', compact('table', 'editData','companies','tableCom'));
    }

    public function tableUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'table_name' => 'required',
        ]);
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        $table = Table::findOrFail($id);
        $table->table_name = $request->table_name;
        $table->table_date = date('Y-m-d', strtotime($request->table_date));
        if($role==0){
            $table->company_id=$request->company_id;
        }else{
            $table->company_id=$public;
        }

        $table->save();

        return redirect()->route('table-List')->with('success', 'Data updated Successful');
    }
}
