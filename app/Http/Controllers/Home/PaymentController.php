<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariation;
use App\Models\Transaction;
use App\PaymentGateway\Pay;
use App\PaymentGateway\ZarinPal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Ramsey\Uuid\Codec\OrderedTimeCodec;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {


        $request->validate([
            'payment_method' => 'required',
            'address_id' => 'required'
        ]);
        $checkCart = $this->checkCart();
        if (array_key_exists('error', $checkCart)) {
            alert()->error($checkCart['error'], 'دقت کنید');
            return redirect()->route('home.index');
        }
        $amounts = $this->getAmounts();
        if (array_key_exists('error', $amounts)) {
            alert()->error($amounts['error'], 'دقت کنید');
            return redirect()->route('home.index');
        }
        if ($request->payment_method == 'pay'){
            $payGateway = new Pay();
            $payGatewayResult = $payGateway->send($amounts, $request->address_id);
            if (array_key_exists('error', $payGatewayResult)) {
                alert()->error($payGatewayResult['error'], 'دقت کنید')->persistent('حله');
                return redirect()->back();
            }else{
                return redirect()->to($payGatewayResult['success']);
            }
        }
        if ($request->payment_method == 'zarinpal') {
            $zarinpalGateway = new ZarinPal();
            $zarinpalGatewayResult = $zarinpalGateway->send($amounts, 'test', $request->address_id);
            if (array_key_exists('error', $zarinpalGatewayResult)) {
                alert()->error($zarinpalGatewayResult['error'], 'دقت کنید')->persistent('حله');
                return redirect()->back();
            } else {
                return redirect()->to($zarinpalGatewayResult['success']);
            }

        }
        alert()->error('درگاه پرداخت انتخابی اشتباه میباشد', 'دقت کنید');
        return redirect()->back();

    }

    public function paymentVerify(Request $request , $gatewayName)
    {
        if ($gatewayName == 'pay'){
            $payGateway = new Pay();
            $payGatewayResult = $payGateway->verify($request->token,$request->status);
            if (array_key_exists('error', $payGatewayResult)) {

                alert()->error($payGatewayResult['error'], 'دقت کنید')->persistent('حله');
                return redirect()->back();
            }else{

                alert()->success($payGatewayResult['success'] , 'با تشکر');
                return redirect()->route('home.index');
            }
        }
        if ($gatewayName == 'zarinpal'){

            $amounts = $this->getAmounts();
            if (array_key_exists('error', $amounts)) {
                alert()->error($amounts['error'], 'دقت کنید');
                return redirect()->route('home.index');
            }

            $zarinpalGateway = new ZarinPal();
            $zarinpalGatewayResult = $zarinpalGateway->verify($request->Authority,$amounts['paying_amount']);
            if (array_key_exists('error', $zarinpalGatewayResult)) {

                alert()->error($zarinpalGatewayResult['error'], 'دقت کنید')->persistent('حله');
                return redirect()->back();
            }else{

                alert()->success($zarinpalGatewayResult['success'] , 'با تشکر');
                return redirect()->route('home.index');
            }
        }
        alert()->error('مسیر بازگشت از درگاه پرداخت اشتباه میباشد', 'دقت کنید');
        return redirect()->route('home.orders.checkout');




    }





    public function checkCart()
    {
        if (\Cart::isEmpty()) {
            return ['error' => 'سبد خرید شما خالی است'];
        }
        foreach (\Cart::getContent() as $item) {
            $variation = ProductVariation::find($item->attributes->id);
            $price = $variation->is_sale ? $variation->sale_price : $variation->price;
            if ($price != $item->price) {
                \Cart::clear();
                return ['error' => 'قیمت این محصول تغییر کرده است'];
            }
            if ($item->quantity > $variation->quantity) {
                \Cart::clear();
                return ['error' => 'تعداد این محصول تغییر کرده است'];

            }
            return ['success' => 'success!'];
        }

    }

    public function getAmounts()
    {
        if (session()->has('coupon')) {
            $checkcoupon = checkCoupon(session()->get('coupon.code'));
            if (array_key_exists('error', $checkcoupon)) {
                return $checkcoupon;
            }
        }
        return [
            'total_amount' => (\Cart::getTotal() + cartTotalSaleAmount()),
            'delivery_amount' => cartTotalDeliveryAmount(),
            'coupon_amount' => session()->has('coupon') ? session()->get('coupon.amount') : 0,
            'paying_amount' => cartTotalAmount()
        ];
    }


}
