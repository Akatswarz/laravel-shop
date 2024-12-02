<?php

namespace App\Http\Controllers;

use App\Models\Vw_products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product = Vw_products::all();
        return view('home.index',['sp'=>$product]);
    }
}
