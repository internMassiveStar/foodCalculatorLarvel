<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodCalculator;
use App\Models\foodorder;
use App\Models\Table;
use App\Models\waiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FoodCalculatorController extends Controller
{ 

    public function trendingOrder(){

        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        if($role==1){
         $trending = DB::table('food_calculators')
        ->join('food', 'food_calculators.food_name', 'food.id')
        ->select('food.foodName', 'food.food_photo','food.food_price', 'food_calculators.food_name')
        ->where('food_calculators.company_id', $public)
        ->whereBetween('food_calculators.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->groupBy('food_calculators.food_name')
        ->orderByRaw('count(*) DESC')
        ->limit(3)
        ->get();
        }else{
            $trending = DB::table('food_calculators')
            ->join('food', 'food_calculators.food_name', 'food.id')
            ->join('companies', 'food_calculators.company_id', 'companies.company_id')
            ->select('food.foodName', 'food.food_photo','food.food_price', 'food_calculators.food_name','companies.company_name')
          
            ->whereBetween('food_calculators.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('food_calculators.food_name')
            ->orderByRaw('count(*) DESC')
            ->limit(3)
            ->get();
        }

       
        
        // dd($trending);

    
       return view('backend.layouts.master',compact('trending'));
    }
   
    public function foodcalulatorList()
    {
        $food = Food::orderBy('foodName', 'ASC')->get();
        $waiter = waiter::orderby('waiter_name', 'DESC')->get();
        $table = Table::orderby('table_name', 'DESC')->get();
        return view('backend.food calculator.food_calculator', compact('waiter', 'table', 'food'));
    }
    public function foodcalulatorAdd(Request $request)
    {
        $validateData = $request->validate([
            'customer_name' => 'required',
            'customer_mobile' => 'required',
        ]);


        $filter_food_quantity = array_values(array_filter($request->food_quantity));
        $filter_sub_total = array_values(array_filter($request->sub_total));

        $count_class = count($filter_food_quantity);

        if ($request->food_quantity != null) {
            for ($i = 0; $i < $count_class; $i++) {

                $food_prices = Food::select('food_price')->where('id', $request->foodchk[$i])->first();
                $fdc = new FoodCalculator();
                $fdc->customer_name = $request->customer_name;
                $fdc->order_id = $request->customer_mobile . date('dhi');
                $fdc->customer_mobile = $request->customer_mobile;
                $fdc->waiter = $request->waiter;
                $fdc->table = $request->table;
                $fdc->food_name = $request->foodchk[$i];
                $fdc->food_price = $food_prices->food_price;
                $fdc->food_quantity = $filter_food_quantity[$i];
                $fdc->sub_total = $filter_sub_total[$i];
                $fdc->item = $request->item;
                $fdc->total_price = $request->total_price;
                $fdc->vat = $request->vat;
                $fdc->grand_price = $request->grand_price;
                $fdc->save();
            }
        }


        $foc = new foodorder();
        $foc->order_id = $request->customer_mobile . date('dhi');
        $foc->order_name = $request->customer_name;
        $foc->order_mobile = $request->customer_mobile;
        $foc->waiter = $request->waiter;
        $foc->table = $request->table;
        $foc->order_item = $request->item;
        $foc->total_price = $request->total_price;
        $foc->vat = $request->vat;
        $foc->grand_price = $request->grand_price;
        $foc->save();




        return redirect()->back()->with('success', 'Data Inserted Successful');
    }

     public function appOrderStore(Request $request){
        $validateData = $request->validate([
            'customer_name' => 'required',
            'customer_mobile' => 'required',
        ]);


       $detail=$request->details;

       print_r($detail);

       if($request->customer_mobile !=null){
        for ($i = 0; $i < count($detail); $i++) {

            $fdc = new FoodCalculator();
            $fdc->customer_name = $request->customer_name;
            $fdc->order_id = $request->customer_mobile . date('dhi');
            $fdc->customer_mobile = $request->customer_mobile;
            $fdc->waiter = $request->waiter;
            $fdc->table = $request->table;
            $fdc->company_id=$request->company_id;
            $fdc->food_name =$detail[$i][0]['food_id'];
            $fdc->food_quantity = $detail[$i][0]['qty'];
            $fdc->sub_total = $detail[$i][0]['sub_total'];
            $fdc->food_price = $detail[$i][0]['food_price'];
        
            $fdc->item = $request->item;
            $fdc->total_price = $request->grand_price;
            $fdc->vat = $request->vat;
            $fdc->grand_price = $request->grand_price;
            $fdc->save();
        }
        $foc = new foodorder();
        $foc->order_id = $request->customer_mobile . date('dhi');
        $foc->order_name = $request->customer_name;
        $foc->order_mobile = $request->customer_mobile;
        $foc->waiter = $request->waiter;
        $foc->table = $request->table;
        $foc->company_id=$request->company_id;
        $foc->order_item = $request->item;
        $foc->total_price = $request->grand_price;
        $foc->vat = $request->vat;
        $foc->grand_price = $request->grand_price;
        $foc->save();

      }
      return response('Order taken');

     }

    public function foodcalulatorEdit($id)
    {

        $editData = FoodCalculator::findOrFail($id);

        return view('backend.food calculator.food_calculator', compact('editData'));
    }


    public function foodorderList()
    {
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        if($role==1){
            $food = DB::table('foodorders')
            ->join('waiters', 'foodorders.waiter', 'waiters.id')
            ->select('waiters.waiter_name', 'foodorders.*')
            ->where('foodorders.kitchen_status', '0')
            ->where('foodorders.company_id',$public)
            ->orderBy('foodorders.id', 'DESC')->get();
        }else{
            $food = DB::table('foodorders')
            ->join('waiters', 'foodorders.waiter', 'waiters.id')
            ->select('waiters.waiter_name', 'foodorders.*')
            ->where('foodorders.kitchen_status', '0')
            ->orderBy('foodorders.id', 'DESC')->get();
        }
    


        return view('backend.food calculator.food_order', compact('food'));
    }

    public function orderList($id)
    {


        $food = DB::table('food_calculators')
            ->join('waiters', 'food_calculators.waiter', 'waiters.id')
            ->join('food', 'food_calculators.food_name', 'food.id')
            ->select('waiters.waiter_name', 'food.foodName', 'food.food_photo', 'food_calculators.*')
            ->where('food_calculators.order_id', $id)
            ->orderBy('food_calculators.id', 'DESC')->get();

        // dd($food);
        return view('backend.food calculator.order', compact('food'));
    }

    public function kitchenStatus($id)
    {
        $kitchenstatus = foodorder::where('order_id', $id)->first();

        // $kitchenstatus = foodorder::findOrFail($id);
        $kitchenstatus->kitchen_status = '1';

        $kitchenstatus->save();
        return redirect()->back()->with('success', 'Food Successfully Deliver To KItchen');
    }
    public function kitchenComplete($id){
        $kitchencomplete = foodorder::where('order_id', $id)->first();

        // $kitchenstatus = foodorder::findOrFail($id);
        $kitchencomplete->kitchen_status = '2';

        $kitchencomplete->save();
        return redirect()->back()->with('success', 'Food Successfully Deliver To KItchen');

    }
    public function priceStatus($id)
    {
        $pricestatus = foodorder::where('order_id', $id)->first();

        // $kitchenstatus = foodorder::findOrFail($id);
        $pricestatus->price_status = '1';

        $pricestatus->save();
        return redirect()->back()->with('success', 'Food Successfully Deliver To KItchen');
    }



    public function kitchenList()
    {
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        if($role==1){
            $kitchencomplete = foodorder::where('kitchen_status', '1')->where('company_id',$public)->get();


        }else{
            $kitchencomplete = foodorder::where('kitchen_status', '1')->get();
        }
        $date = date('Y-m-d');
        // dd($kitchencomplete);
        return view('backend.food calculator.kitchen_complete', compact('kitchencomplete'));
    }

    public function priceList()
    {
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        if($role==1){
            $pricelists = foodorder::where('kitchen_status', '3')->where('price_status','0')->where('company_id',$public)->get();

        }else{
            $pricelists = foodorder::where('kitchen_status', '3')->where('price_status','0')->get();

        }

        return view('backend.food calculator.foodprice_complete',compact('pricelists'));
    }
}
