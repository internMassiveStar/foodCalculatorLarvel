<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Company;
use App\Models\User;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function foodList()
    {
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
       
       // $companies=Company::orderBy('id','DESC')->get();
       if($role==1){
        $companies=User::where('public_key',$public)->get();
        $food = Food::where('company_id',$public)->get();
        $foodCom=DB::table('food')
        ->join('users','food.company_id','users.public_key')
        ->select('users.company_name','food.*')
        ->where('food.company_id',$public)
        ->orderBy('food.id','DESC')->get();
       
       }else{
        $companies=User::orderBy('id', 'DESC')->get();
        $food = Food::orderBy('id', 'DESC')->get();
        $foodCom=DB::table('food')
        ->join('users','food.company_id','users.public_key')
        ->select('users.company_name','food.*')
       
        ->orderBy('food.company_id')->get();
      
       }
       

       
      
    return view('backend.food.food', compact('food','companies','foodCom'));
   
       

    }
    
    public function appFoodList($id){
        $foods = Food::orderBy('id', 'DESC')->where('company_id',$id)->get();
        return response()->json($foods);
    }

    public function foodAdd(Request $request)
    {
        $validateData = $request->validate([
            'foodName' => 'required',

            'food_price' => 'required',


        ]);

        $foodimage = $request->file('food_photo');
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;

        if($role==0){
            $company_id=$request->company_id;
        }else{
            $company_id=$public;
        }

        if ($foodimage) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($foodimage->getClientOriginalExtension());
            $img_name = $name_gen . "." . $img_ext;
            $up_location = 'food_image/';
            $last_img = $up_location . $img_name;
            $foodimage->move($up_location, $img_name);

            Food::create([
                'foodName' => $request->foodName,
                'company_id' =>  $company_id,
                'food_price' => $request->food_price,
                'food_date' => $request->food_date,
                'food_photo' => $last_img,
            ]);
        } else {
            Food::create([
                'foodName' => $request->foodName,
                'company_id' =>  $company_id,
                'food_price' => $request->food_price,
                'food_date' => $request->food_date,

            ]);
        }

        return redirect()->route('food-List')->with("success", 'Data added Successfully');
    }

    public function foodEdit($id)
    {
        $food = Food::orderBy('id', 'DESC')->get();
        $editData = Food::findOrFail($id);
        $public=Auth::user()->public_key;
        $role=Auth::user()->role;
        if($role==1){
            $companies=User::where('public_key',$public)->get();
           
           }else{
            $companies=User::orderBy('id', 'DESC')->get();
          
           }
        $foodCom=[];

        return view('backend.food.food', compact('editData', 'food','companies','foodCom'));
    }

    public function foodUpdate(Request $request, $id)
    {
        $fooddata = Food::findOrFail($id);

        $foodimage = $request->file('food_photo');

        if ($foodimage) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($foodimage->getClientOriginalExtension());
            $img_name = $name_gen . "." . $img_ext;
            $up_location = 'food_image/';
            $last_img = $up_location . $img_name;
            $foodimage->move($up_location, $img_name);

            $path = public_path('/' . $fooddata->food_image);

            if (File::exists($path)) {
                @unlink($path);
            }

            Food::find($id)->update([

                'foodName' => $request->foodName,
                'food_price' => $request->food_price,
                'company_id' => $request->company_id,
                'food_date' => $request->food_date,
                'food_photo' => $last_img,
            ]);

            return redirect()->route('food-List')->with("success", 'Data Updated Successfully');
        } else {
            Food::find($id)->update([

                'foodName' => $request->foodName,
                'food_price' => $request->food_price,
                'company_id' => $request->company_id,
                'food_date' => $request->food_date,
            ]);
        }

        return redirect()->route('food-List')->with("success", 'Data added Successfully');
    }
}
