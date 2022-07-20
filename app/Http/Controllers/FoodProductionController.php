<?php

namespace App\Http\Controllers;

use App\Models\foodorder;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class FoodProductionController extends Controller
{
    
    public function foodorderList()
    {
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        if($role==1){
            $food = DB::table('foodorders')
            ->join('waiters', 'foodorders.waiter', 'waiters.id')
            ->select('waiters.waiter_name', 'foodorders.*')
            ->where('foodorders.kitchen_status', '2')
            ->where('foodorders.company_id', $public)
            ->orderBy('foodorders.id', 'DESC')->get();
        }else{

            $food = DB::table('foodorders')
            ->join('waiters', 'foodorders.waiter', 'waiters.id')
            ->select('waiters.waiter_name', 'foodorders.*')
            ->where('foodorders.kitchen_status', '2')
            ->orderBy('foodorders.id', 'DESC')->get();
        }
        


        return view('backend.foodproduction.food_production', compact('food'));
    }

    public function foodProductionAdd(){
        return view('backend.foodproduction.food_production');
    }
    public function ingredient(Request $request){

        $validateData = $request->validate([

            'ingredient' => 'required',
            'item_name' => 'required',
            'order_id'=>'required'

        ]);

        $public=Auth::user()->public_key;


        $recipe = new Recipe();
        $recipe->order_id=$request->order_id;
        $recipe->item_name = $request->item_name;
        $recipe->company_id = $public;

        $recipe->ingredient = $request->ingredient;
        $recipe->comments = $request->comments;

      
        $recipe->save();

        return redirect()->back()->with('success', 'Data Inserted Successful');
    }
    public function foodproductionList(){
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        if($role==1){
            $productions = DB::table('recipes')
            ->join('users', 'recipes.company_id', 'users.public_key')
            ->select('users.company_name', 'recipes.*')
            
            ->where('recipes.company_id', $public)
            ->orderBy('recipes.id', 'DESC')->get();
        }else{

            $productions = DB::table('recipes')
            ->join('users', 'recipes.company_id', 'users.public_key')
            ->select('users.company_name', 'recipes.*')
            ->orderBy('recipes.id', 'DESC')->get();
        }
        
        return view('backend.foodproduction.productionList', compact('productions'));
    }
    public function productionStatus($id){
        $kitchencomplete = foodorder::where('order_id', $id)->first();

        // $kitchenstatus = foodorder::findOrFail($id);
        $kitchencomplete->kitchen_status = '3';

        $kitchencomplete->save();
        return redirect()->back()->with('success', 'Food Successfully Deliver');

    }
}
