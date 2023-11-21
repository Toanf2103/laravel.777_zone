<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Site\OrderService;
use App\Services\Site\ProductService;

use App\Services\Site\CartService;
use App\Services\Site\MailService;
use App\Services\Site\VnpayService;
use App\Services\Site\MomoService;
use Illuminate\Support\Facades\Validator;
use \PDF;
use Exception;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $prodSer;
    protected $cartService;
    protected $mailService;

    public function __construct(ProductService $prodSer, CartService $cartService, MailService $mailService)
    {

        $this->prodSer = $prodSer;
        $this->cartService = $cartService;
        $this->mailService = $mailService;
    }

    public function order(Request $request)
    {

        $rq = $request->all();
        $listProduct = $this->prodSer->getOrderProductsById($rq['prod']);
        return view('site.pages.order', compact('listProduct'));
    }

    public function orderMenu(Request $request)
    {

        try {
            $validated = $request->validate([
                'type' => 'in:waiting,approved,shipping,completed,cancel,creating'
            ]);
        } catch (Exception $e) {
            return redirect()->route('site.order.menu');
        }

        $type = $request->get('type') ?? 'waiting';
        $user = Auth::guard('user')->user();
        // dd($user);
        $orders = Order::where('status', $type)->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        // dd($orders);
        return view('site.pages.orderMenu', compact('orders'));
    }

    public function checkout(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'username' => 'required',
            'phone-number' => 'required',
            'email' => 'nullable|email',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'type-pay' => 'required|in:momo,vnpay,cod',
            'products' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Có lỗi !')->withInput();
        }
        // dd(1);

        $orderServ = new OrderService();

        $listProduct = [];
        foreach ($request['products'] as $product) {

            $prod = $this->prodSer->findProductById($product, true);
            $quantityCart = $this->cartService->getQuatityProduct($product);
            if ($prod === false || $quantityCart == false || $prod->quantity < $quantityCart) {
                return redirect()->route('site.cart')->with('error', 'Sản phẩm bạn đặt đã hết hàng!');
            }
            $prod['quantityCart'] = $quantityCart;
            $listProduct[] = $prod;
        }

        //Tạo đơn hàng
        $order = $orderServ->create($request->all(), $listProduct);
        $totalPrice = $order->totalPrice();

        switch ($request['type-pay']) {
            case 'cod':
                //Chuyển trạng thái đơn hàng
                $order->status = 'waiting';
                $order->save();
                //Gửi email hóa đơn về
                $this->mailService->sendMailOrder($order);

                //Trừ số lượng của sản phẩm khi đặt hàng thành công
                $this->prodSer->minusQuantity($order);

                //Xóa sản phẩm ra khỏi giỏ hàng
                $listProduct = $order->orderDetails->pluck('product_id');
                $this->cartService->deleteListProduct($listProduct);



                return redirect()->route('site.showBillOrder', ['orderId' => $order->id])->with('arlet', 'Đặt hàng thành công');
            case 'vnpay':
                $vnpaySer = new VnpayService();
                $urlCheckout = $vnpaySer->vnpayCheckout($order, $totalPrice);
                if ($urlCheckout === false) {
                    return redirect()->back()->with('error', 'Có lỗi !')->withInput();
                }
                return redirect()->to($urlCheckout);
            case 'momo':
                $momoSer = new MomoService();
                $urlCheckout = $momoSer->momoCheckout($order, $totalPrice);
                if ($urlCheckout === false) {
                    return redirect()->back()->with('error', 'Có lỗi momo!')->withInput();
                }
                return redirect()->to($urlCheckout);

            default:
                return redirect()->route('site.cart');
        }
    }
    public function vnpayCheckoutDone(Request $request)
    {
        $orderServ = new OrderService();

        $data = $request->all();
        if ($data['vnp_TransactionStatus'] === "00"  && $data['vnp_ResponseCode'] === "00") {

            //Lấy đơn hàng thông qua id được trả về
            $order = $orderServ->getOrderById($data['order_id']);

            //Chuyển trạng thái đơn hàng
            $order->status = 'waiting';
            $order->pay_status = true;
            $order->save();

            //Gửi email hóa đơn về
            $this->mailService->sendMailOrder($order);

            //Trừ số lượng của sản phẩm khi đặt hàng thành công
            $this->prodSer->minusQuantity($order);

            //Xóa sản phẩm ra khỏi giỏ hàng
            $check = $this->cartService->deleteListProduct($order->orderDetails->pluck('product_id'));
            return redirect()->route('site.showBillOrder', ['orderId' => $order->id])->with('alert', 'Đặt hàng thành công');
        }

        return redirect()->route('site.cart')->with('error', 'Có lỗi trong quá trình thanh toán');
    }
    public function momoCheckoutDone(Request $request)
    {
        $orderServ = new OrderService();
        $data = $request->all();
        if ($data['resultCode'] === "0") {

            //Lấy đơn hàng thông qua id được trả về
            $order = $orderServ->getOrderById($data['order_id']);

            //Chuyển trạng thái đơn hàng
            $order->status = 'waiting';
            $order->pay_status = true;
            $order->save();

            //Gửi email hóa đơn về
            $this->mailService->sendMailOrder($order);

            //Trừ số lượng của sản phẩm khi đặt hàng thành công
            $this->prodSer->minusQuantity($order);

            //Xóa sản phẩm ra khỏi giỏ hàng
            $check = $this->cartService->deleteListProduct($order->orderDetails->pluck('product_id'));

            return redirect()->route('site.showBillOrder', ['orderId' => $order->id])->with('alert', 'Đặt hàng thành công');
        }
        return redirect()->route('site.cart')->with('error', 'Có lỗi trong quá trình thanh toán');
    }
    public function showBillOrder($orderId)
    {
        $orderSer =  new OrderService();
        $order = $orderSer->getOrderById($orderId);

        // dd($order);
        return view('site.pages.showBillOrder', compact('order'));
    }
    public function pdfOrder($orderId)
    {
        $orderSer =  new OrderService();
        $order = $orderSer->getOrderById($orderId);
        $pdf = PDF::loadView('site.partials.billPdf', compact('order'))->setPaper('a4');
        return $pdf->stream('example.pdf');
    }

    public function buyNow($idProduct)
    {
        $product = $this->prodSer->findProductById($idProduct);
        $this->cartService->addProduct($product);
        return redirect()->route('site.cart');
    }
}
