<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Vw_carts;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');

    }
    public function view()
    {
        if (!auth()->check()) {
            return response()->json([
                'err' => true,
                'mess' => 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.'
            ]);
        }
        $data = Vw_carts::where('iduser', auth()->id())->get();
        $html = "";
        $t = 0;
        $all = 0;
        if ($data->isNotEmpty()) {
            foreach ($data as $i) {
                $t = number_format($i['gia'] * $i['soluong']) . " đ";
                $html .= "<div class='col-md-2 col-lg-2 col-xl-2'>
                <img src='/assets/{$i->images}' class='img-fluid rounded-3' alt='{$i->name}'>
            </div>
            <div class='col-md-3 col-lg-2 col-xl-3'>
                <h6>{$i->name}</h6>
            </div>
            <div class='col-md-2 col-lg-2 col-xl-1 d-flex'>
                <button class='btn btn-link px-2' onclick='capNhatSoLuong(-1, {$i->idpv})'>
                    <i class='fas fa-minus'></i>
                </button>
                <input id='form1' min='1' name='quantity' style='width:50px' value='{$i->soluong}'
                    type='number' class='form-control form-control-sm p-1'
                    onblur='capNhatSoLuong(this.value - {$i->soluong}, {$i->idpv})' />
                <button class='btn btn-link px-2' onclick='capNhatSoLuong(1, {$i->idpv})'>
                    <i class='fas fa-plus'></i>
                </button>
            </div>
            <div class='col-md-3 col-lg-4 col-xl-3 offset-lg-1 text-center'>
                <h6 class='mb-0'>" . number_format($i->gia * $i->soluong) . "đ</h6>
            </div>
            <div class='col-md-1 col-lg-1 col-xl-1 text-end'>
                <button class='text-muted' onclick='xoaSanPham({$i->idpv})'><i class='fas fa-times'></i></button>
            </div><hr class='my-5'>";
                $all += (int) str_replace(",", "", $t);
            }
        } else {
            $html = '<p>Giỏ hàng của bạn trống!</p>';
        }
        return response()->json([
            'html' => $html,
            'all' => number_format($all),
        ]);
    }
    public function add(Request $req)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!auth()->check()) {
            return response()->json([
                'err' => true,
                'mess' => 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.'
            ]);
        }

        $idpv = $req->input('idpv');

        $userId = auth()->id();
        $cartItem = Cart::where('iduser', $userId)->where('idpv', $idpv)->first();
        try {
            if (!$cartItem) {
                Cart::create([
                    'iduser' => $userId,
                    'idpv' => $idpv,
                    'soluong' => 1,
                ]);
            } else {
                Cart::where('idpv', $idpv)
                ->where('iduser', $userId)
                ->update(['soluong' => $cartItem->soluong+1]);
            }

            return response()->json([
                'err' => false,
                'mess' => 'Sản phẩm đã được thêm vào giỏ hàng!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'err' => true,
                'mess' => 'Lỗi khi thêm sản phẩm vào giỏ hàng.',
            ]);
        }
    }

    public function update(Request $req)
    {
        try {
            // Lấy thông tin sản phẩm từ request
            $idpv = $req->input('idpro'); // ID sản phẩm
            $sl = $req->input('sl', 1); // Số lượng sản phẩm

            // Lấy ID người dùng từ session hoặc cookie
            $userId = Auth::id();

            // Kiểm tra xem sản phẩm đã có trong giỏ chưa
            $cartItem = Cart::where('idpv', $idpv)->where('iduser', $userId)->first();

            // Nếu có sản phẩm trong giỏ
            if ($cartItem) {
                $newQuantity = $cartItem->soluong + $sl;

                // Kiểm tra số lượng có hợp lệ không
                if ($newQuantity < 1) {
                    return response()->json(['err' => true, 'mess' => 'Số lượng không được nhỏ hơn 1']);
                }
                $sl+=$cartItem->soluong;
                // Cập nhật lại số lượng trong giỏ
                Cart::where('idpv', $idpv)
                ->where('iduser', $userId)
                ->update(['soluong' => $newQuantity]);
                

                return response()->json(['err' => false, 'mess' => 'Cập nhật giỏ hàng thành công']);
            } else {
                // Nếu không có sản phẩm trong giỏ, thêm sản phẩm vào giỏ
                Cart::create([
                    'idpv' => $idpv,
                    'iduser' => $userId,
                    'soluong' => max(1, $sl)
                ]);

                return response()->json(['err' => false, 'mess' => 'Đã thêm sản phẩm vào giỏ hàng']);
            }
        } catch (Exception $e) {
            // Xử lý lỗi khi có ngoại lệ
            return response()->json(['err' => true, 'mess' => 'Có lỗi xảy ra khi cập nhật giỏ hàng']);
        }
    }
    public function remove(Request $req)
    {
        if (!auth()->check()) {
            return response()->json([
                'err' => true,
                'mess' => 'Bạn cần đăng nhập để thực hiện thao tác này!',
            ]);
        }

        $userId = auth()->id();
        $idpv = $req->input('idpro');

        // Kiểm tra sản phẩm có tồn tại trong giỏ hàng
        $cartItem = Cart::where([['iduser', $userId],['idpv', $idpv]])->first();
        if ($cartItem) {
            Cart::where('idpv', $idpv)
                ->where('iduser', $userId)
                ->delete();
            return response()->json([
                'err' => false,
                'mess' => 'Sản phẩm đã được xóa khỏi giỏ hàng!',
            ]);
        }
        
        
        // Trường hợp sản phẩm không tồn tại
        return response()->json([
            'err' => true,
            'mess' => 'Sản phẩm không tồn tại trong giỏ hàng!',
        ]);
    }

    public function totalProductsInCart(){
        
        $data = Cart::where('iduser', Session('us_id') )->get();
        $sl = 0;
        foreach($data as $i){
            $sl += $i['soluong'];
        }
        echo json_encode($sl);
    }
}
