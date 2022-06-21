<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodProductionController extends Controller
{
    public function foodProduction()
    {
        return view('backend.foodproduction.food_production');
    }

    public function foodProductionAdd(){
        return view('backend.foodproduction.food_production');
    }
}
