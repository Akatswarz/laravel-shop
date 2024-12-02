<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Vw_products;

class ProductController extends Controller
{
    public function index(string $cat, int $p = 1){
        $size = 1;
        $idCat = Menu::where('slug', $cat)->first()->idCat;
        $listIdCat = Category::where('id', $idCat)
        ->orWhere('parent_id', $idCat)->pluck('id')->toArray();
        $skip = ($p - 1) * $size;
        $sanPham = Vw_products::whereIn('idCat', $listIdCat)->skip($skip)->take($size)->get();
        $sotrang = ceil(count(Vw_products::whereIn('idCat', $listIdCat)->get()))/$size;
        
        return view('products.index', [
            'sp' => $sanPham, 
            'sotrang' => $sotrang, 
            'page' => $p, 
            'url' => $cat
        ]);
    }
    public function detail(string $cat, String $slug){
        $products = Vw_products::where('slug', $slug)->first();
        $idCha = Menu::where('idCat', $cat)->first();
        $idCha = $idCha->idCha;
        $idCat = Menu::where('idCha', $idCha)->pluck('idCat');
        $related = Vw_products::whereIn('idCat', $idCat)->where('slug','!=' ,$slug)->get();
        // dd($related);
        return view('products.detail',['sp' => $products, 'cat' => $cat, 'related' => $related]);
    }

    public function list(string $slug = '', int $id = null){
        $idCat = Category::where('parent_id', $id)->pluck('id');
        $products = Vw_products::whereIn('idCat', $idCat)->get();
        return view('products.index',['sp' => $products, 'sotrang' => null, 'page'=>1, 'url' => $slug]);
    }
}
