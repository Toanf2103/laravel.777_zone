@php
use App\Helpers\DateHelper;
use App\Helpers\NumberHelper;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        .wrapper-pdf {
            width: 100%;
            margin: 0 auto;
            border: 1px solid gray;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'DejaVu Sans', sans-serif !important;
        }

        .wrapper-pdf>* {
            font-family: 'DejaVu Sans', sans-serif !important;

        }

        .header-pdf {
            background-color: #96588a;
            color: #fff;
            padding: 30px 40px;
        }

        .container-pdf {
            width: 90%;
            margin: 50px auto;
            background-color: #fff;
        }

        .container-pdf .text-title {
            color: #96588a;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }

        .container-pdf table {
            margin-top: 20px;
        }

        .wrapper-pdf {
            color: #000;
        }

        .wrapper-pdf a {
            color: #96588a;

        }
    </style>
</head>

<body>
    <div class="wrapper-pdf">

        <div class="header-pdf">
            <h1>Cảm ơn bạn đã đặt hàng</h1>
        </div>
        <div class="container-pdf">
            <p style="margin:0 0 16px">Xin chào {{ $order->name }}</p>
            <br>
            <p style="margin:0 0 16px">Đơn hàng #{{ $order->id }} đã được đặt thành công và chúng tôi đang xử lý</p>
            <p class="text-title">[Đơn hàng #{{ $order->id }}] {{ DateHelper::convertDateFormat($order->created_at) }}</p>
            <table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'DejaVu Sans', sans-serif">
                <thead>
                    <tr>
                        <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Sản phẩm</th>
                        <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Số lượng</th>
                        <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderDetails as $item)
                    <tr>
                        <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'DejaVu Sans', sans-serif;word-wrap:break-word">
                            {{$item->product->name}}
                        </td>
                        <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'DejaVu Sans', sans-serif">
                            {{$item->quantity}}
                        </td>
                        <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'DejaVu Sans', sans-serif">
                            <span>{{ NumberHelper::format($item->price*$item->quantity) }}<span>₫</span></span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px">Tổng giá:</th>
                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px"><span>{{ NumberHelper::format($order->totalPrice()-$order->ship_fee) }}<span>₫</span></span></td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Phí ship:</th>
                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span>{{ NumberHelper::format($order->ship_fee) }}<span>₫</span></span></td>
                    </tr>

                    <tr>
                        <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Phương thức thanh toán:</th>
                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">{{ $order->pay_method }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Tổng cộng:</th>
                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span>{{ NumberHelper::format($order->totalPrice()) }}<span>₫</span></span></td>
                    </tr>
                </tfoot>
            </table>
            <p class="text-title">Địa chỉ thanh toán</p>
            <address style="padding:12px;color:#636363;border:1px solid #e5e5e5">
                @if($order->address !== null)
                {{$order->address}},
                @endif
                {{ $order->nameAddress() }}
                <br>
                <span>SDT: {{ $order->phone_number }}</span>
            </address>
            <br>
            <p style="margin:0 0 16px">Thanks for using <a href="{{ route('site.home') }}" target="_blank">777-Zone.com</a>!</p>
        </div>
    </div>
</body>

</html>