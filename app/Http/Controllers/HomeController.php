<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $houses = House::orderBy('created_at', 'desc')->get();

        return view('frontend.index', compact('houses'));
    }

    public function detail($id){
        $decryptId = decryptId($id);
        $house = House::with('blocks')->where('id', $decryptId)->first();

        return view('frontend.house.detail', compact('house'));
    }
}
