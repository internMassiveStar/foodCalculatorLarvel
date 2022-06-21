<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function tableList()
    {
        $table = Table::orderBy('id', 'DESC')->get();
        return view('backend.table.table', compact('table'));
    }
    public function appTableList(){
        $tables = Table::orderBy('id', 'DESC')->get();
        return response()->json($tables);
    }
    public function tableAdd(Request $request)
    {
        $validateData = $request->validate([

            'table_name' => 'required',
            'table_date' => 'required',

        ]);

        $table = new Table();
        $table->table_name = $request->table_name;
        $table->table_date = date('Y-m-d', strtotime($request->table_date));
        $table->save();

        return redirect()->back()->with('success', 'Data Inserted Successful');
    }


    public function tableEdit($id)
    {

        $table = Table::orderBy('id', 'DESC')->get();
        $editData = Table::findOrFail($id);
        return view('backend.table.table', compact('table', 'editData'));
    }

    public function tableUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'table_name' => 'required',
        ]);

        $table = Table::findOrFail($id);
        $table->table_name = $request->table_name;
        $table->table_date = date('Y-m-d', strtotime($request->table_date));
        $table->save();

        return redirect()->route('table-List')->with('success', 'Data updated Successful');
    }
}
