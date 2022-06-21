<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function foodList()
    {
        $food = Food::orderBy('id', 'DESC')->get();
      
    return view('backend.food.food', compact('food'));
   
       

    }
    
    public function appFoodList(){
        $foods = Food::orderBy('id', 'DESC')->get();
        return response()->json($foods);
    }

    public function foodAdd(Request $request)
    {
        $validateData = $request->validate([
            'foodName' => 'required',

            'food_price' => 'required',


        ]);

        $foodimage = $request->file('food_photo');

        if ($foodimage) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($foodimage->getClientOriginalExtension());
            $img_name = $name_gen . "." . $img_ext;
            $up_location = 'food_image/';
            $last_img = $up_location . $img_name;
            $foodimage->move($up_location, $img_name);

            Food::create([
                'foodName' => $request->foodName,
                'food_price' => $request->food_price,
                'food_date' => $request->food_date,
                'food_photo' => $last_img,
            ]);
        } else {
            Food::create([
                'foodName' => $request->foodName,
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

        return view('backend.food.food', compact('editData', 'food'));
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
                'food_date' => $request->food_date,
                'food_photo' => $last_img,
            ]);

            return redirect()->route('food-List')->with("success", 'Data Updated Successfully');
        } else {
            Food::find($id)->update([

                'foodName' => $request->foodName,
                'food_price' => $request->food_price,
                'food_date' => $request->food_date,
            ]);
        }

        return redirect()->route('food-List')->with("success", 'Data added Successfully');
    }
}
