<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }
    public function addForm()
    {
        return view('admin.product.add');
    }
    public function add(Request $req)
    {

        $req->validate([
            'name' => 'required|max:255',
            'slug' => 'string|max:255',
            'mota' => 'string',
            'th' => 'string',
            'idCat' => 'required',
            'images' => 'nullable|image',
        ]);

        $product = new Product();
        $product->name = $req->name;
        $product->slug = $req->slug;
        $product->mota = $req->mota;
        $product->th = $req->th;
        $product->idCat = $req->idCat;
        $product->chitiet = $req->chitiet;
        if ($req->hasFile('images')) {
            $imgname = time() . '.' . $req->file('images')->getClientOriginalExtension();
            $req->file('images')->storeAs('assets/san-pham', $imgname, 'public');

            $product->images = 'img/san-pham/' . $imgname;
        }

        $product->save();
        return redirect()->route('admin.product')->with(['e' => false, 'm' => 'Thêm sản phẩm thành công']);
    }
    public function editForm($id)
    {   
        $product = Product::findOrFail($id);
        if ($product == null) {
            return redirect()->route('admin.product')->with(['e' => true,'m' => 'Không tìm thấy sản phẩm']);
        }
        return view('admin.product.edit', compact('product'));
    }
    public function edit(Request $req)
    {
        $product = Product::findOrFail($req->id);

        $product->name = $req->name;
        $product->slug = $req->slug;
        $product->mota = $req->mota;
        $product->th = $req->th;
        $product->idCat = $req->idCat;

        if ($req->hasFile('images')) {
            
            $imageName = time() . '.' . $req->file('images')->getClientOriginalExtension();
            $req->file('images')->storeAs('assets/san-pham', $imageName, 'public');
            $product->images = 'img/san-pham/'.$imageName;
        }

        $product->save();

        return redirect()->route('admin.product')->with('success', 'Product updated successfully');
    }
    public function remove($id)
    {
        $product = Product::find($id);
        if ($product) {
            Product::where('id', $id)
                ->delete();
            return redirect()->route('admin.product')->with(['e' => false, 'm' => 'Xóa thành công']);
        }
        return redirect()->route('admin.product')->with(['e' => true, 'm' => 'Lỗi không hợp lệ']);
    }
}
