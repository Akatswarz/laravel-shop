<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function sendEmail()
    {
        if (auth()->check()) {
            try {
                $id = session()->get('us_id');
                $email = auth()->user()->email;

                Mail::raw('Cảm ơn đã mua sản phẩm của chúng tôi ', function ($message) use ($email) {
                    $message->from('minhhuy050799@gmail.com', 'Minh Huy');
                    $message->to($email)->subject('Order Confirmation');
                });

                Cart::where('iduser', $id)->delete();

                return redirect()->route('cart.index')->with('success', 'Bạn đã thanh toán hoàn tất');
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
}
