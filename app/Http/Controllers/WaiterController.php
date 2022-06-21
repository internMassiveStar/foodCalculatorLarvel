<?php

namespace App\Http\Controllers;

use App\Models\waiter;
use Illuminate\Http\Request;

class WaiterController extends Controller
{
    public function waiterList()
    {

        $waiter = waiter::orderBy('id', 'DESC')->get();
        return view('backend.waiter.waiter', compact('waiter'));
    }
    public function appWaiterList()
    {

        $waiters = waiter::orderBy('id', 'DESC')->get();
        return response()->json($waiters);
    }

    public function waiterAdd(Request $request)
    {
        $validateData = $request->validate([

            'waiter_name' => 'required',
        ]);

        $waiter = new waiter();
        $waiter->waiter_name = $request->waiter_name;
        $waiter->waiter_date = date('Y-m-d', strtotime($request->waiter_date));
        $waiter->save();

        return redirect()->back()->with('success', 'Data Inserted Successful');
    }

    public function waiterEdit($id)
    {

        $waiter = waiter::orderBy('id', 'DESC')->get();
        $editData = waiter::findOrFail($id);
        return view('backend.waiter.waiter', compact('waiter', 'editData'));
    }

    public function waiterUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'waiter_name' => 'required',
        ]);

        $waiter = waiter::findOrFail($id);
        $waiter->waiter_name = $request->waiter_name;
        $waiter->waiter_date = date('Y-m-d', strtotime($request->waiter_date));
        $waiter->save();

        return redirect()->route('waiter-List')->with('success', 'Data updated Successful');
    }
}
