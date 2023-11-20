<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\AddressService;
use Illuminate\Http\Request;
use App\Services\Site\OrderService;
use App\Services\Site\ProductService;

use App\Services\Site\CartService;
use App\Services\Site\MailService;
use App\Services\Site\VnpayService;
use App\Services\Site\MomoService;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\PDF;
use Exception;

class OrderController extends Controller
{
    protected $prodSer;
    protected $cartService;
    protected $mailService;

    public function __construct(ProductService $prodSer, CartService $cartService, MailService $mailService)
    {
        $this->middleware('checkUser');

        $this->prodSer = $prodSer;
        $this->cartService = $cartService;
        $this->mailService = $mailService;
    }
    public function testOrder()
    {
        $se = new AddressService();
        $se->getNameAdress(11140);
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
        $orders = Order::where('status', $type)->get();
        return view('site.pages.orderMenu', compact('orders'));
    }

    public function checkout(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'username' => 'required',
            'phone-number' => 'required',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'type-pay' => 'required|in:momo,vnpay,cod',
            'products' => 'required',

        ]);

        if ($validator->fails()) {
            // Handle validation failure
            // dd(1);
            return redirect()->back()->with('error', 'Có lỗi !')->withInput();
        }

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
        // dd($request->all());
        $order = $orderServ->create($request->all(), $listProduct);
        $totalPrice = 0;
        $totalPrice = $totalPrice + $order->ship_fee;
        foreach ($listProduct as $product) {
            $totalPrice += $product->price * $product->quantityCart;
        }
        switch ($request['type-pay']) {
            case 'cod':
                $order->status = 'waiting';
                $order->save();
                $listProduct = $order->orderDetails->pluck('product_id');
                // dd($listProduct);
                $this->cartService->deleteListProduct($listProduct);
                $this->mailService->sendMailOrder($order);

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
            $order = $orderServ->getOrderById($data['order_id']);
            $order->status = 'waiting';
            $order->pay_status = true;
            $order->save();
            // dd('1');
            $this->mailService->sendMailOrder($order);

            $check = $this->cartService->deleteListProduct($order->orderDetails->pluck('product_id'));
            return redirect()->route('site.showBillOrder', ['orderId' => $order->id])->with('alert', 'Đặt hàng thành công');
        }
        // dd('2');

        return redirect()->route('site.cart')->with('error', 'Có lỗi trong quá trình thanh toán');
    }
    public function momoCheckoutDone(Request $request)
    {
        $orderServ = new OrderService();
        $data = $request->all();
        if ($data['resultCode'] === "0") {
            $order = $orderServ->getOrderById($data['order_id']);
            $order->status = 'waiting';
            $order->pay_status = true;
            $order->save();
            $check = $this->cartService->deleteListProduct($order->orderDetails->pluck('product_id'));
            $this->mailService->sendMailOrder($order);

            return redirect()->route('site.showBillOrder', ['orderId' => $order->id])->with('alert', 'Đặt hàng thành công');
        }
        return redirect()->route('site.cart')->with('error', 'Có lỗi trong quá trình thanh toán');
    }
    public function showBillOrder($orderId)
    {
        $orderSer =  new OrderService();
        $order = $orderSer->getOrderById($orderId);
       

        return view('site.pages.showBillOrder', compact('order'));
    }
    public function pdfOrder($orderId)
    {
        $orderSer =  new OrderService();
        $order = $orderSer->getOrderById($orderId);
        $pdf = PDF::loadView('site.partials.billPdf', compact('order'))->setPaper('a4');
        return $pdf->stream('example.pdf');
    }
}
