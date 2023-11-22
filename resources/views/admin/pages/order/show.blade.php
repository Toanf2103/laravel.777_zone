@php
use App\Helpers\NumberHelper;
@endphp

@extends('admin.layouts.main')

@section('title', 'Chi tiết đơn hàng - 777 Zone Admin')
@section('title-content', 'Chi tiết đơn hàng')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/order/show.css') }}">
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.orders.index') }}">Đơn hàng</a></li>
<li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
@stop

@section('content')
<div class="d-flex flex-column gap-4">
    @if (session('success'))
    <div class="col-12">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
    @endif

    <div class="d-flex justify-content-end align-items-center gap-3">
        @if($order->status == 'waiting')
        <a href="{{ route('admin.orders.changeStatus', ['order' => $order->id, 'status' => 'approved']) }}" class="btn btn-success">Duyệt đơn hàng</a>
        @elseif($order->status == 'approved')
        <a href="{{ route('admin.orders.changeStatus', ['order' => $order->id, 'status' => 'shipping']) }}" class="btn btn-success">Giao cho đơn vị vận chuyển</a>
        @elseif($order->status == 'shipping')
        <a href="{{ route('admin.orders.changeStatus', ['order' => $order->id, 'status' => 'completed']) }}" class="btn btn-success">Khách hàng đã nhận được hàng</a>
        @endif

        @if($order->status != 'completed' && $order->status != 'cancel')
        <a href="{{ route('admin.orders.changeStatus', ['order' => $order->id, 'status' => 'cancel']) }}" class="btn btn-danger">Hủy đơn hàng</a>
        @endif
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <h4 class="fw-bold">Thông tin khách hàng</h4>
            <div class="table-responsive">
                <table class="table table-bordered align-middle m-0">
                    <tr>
                        <th>Họ và tên</th>
                        <td>{{ $order->name }}</td>
                    </tr>
                    <tr>
                        <th>Số điện thoại</th>
                        <td>{{ $order->phone_number }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $order->email }}</td>
                    </tr>
                    <tr>
                        <th>Địa chỉ giao hàng</th>
                        <td>{{ $order['full_address'] }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <h4 class="fw-bold">Thông tin đơn hàng</h4>
            <div class="table-responsive">
                <table class="table table-bordered align-middle m-0">
                    <tr>
                        <th>Phương thức thanh toán</th>
                        <td>{{ $order->pay_method }}</td>
                    </tr>
                    <tr>
                        <th>Pay id</th>
                        <td>{{ $order->pay_id }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái thanh toán</th>
                        <td>
                            @if($order->pay_status)
                            <span class='badge bg-success'>Đã thanh toán</span>
                            @else
                            <span class='badge bg-secondary'>Chưa thanh toán</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Trạng thái đơn hàng</th>
                        <td>
                            @if($order->status == 'waiting')
                            <span class='badge bg-warning'>Đang chờ duyệt</span>
                            @elseif($order->status == 'approved')
                            <span class='badge bg-success'>Đã duyệt</span>
                            @elseif($order->status == 'shipping')
                            <span class='badge bg-success'>Đang giao hàng</span>
                            @elseif($order->status == 'completed')
                            <span class='badge bg-success'>Giao hàng thành công</span>
                            @elseif($order->status == 'cancel')
                            <span class='badge bg-danger'>Đã hủy</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Tổng giá sản phẩm</th>
                        <td>{{ NumberHelper::format($order->totalPrice()) }}đ</td>
                    </tr>
                    <tr>
                        <th>Phí vận chuyển</th>
                        <td>{{ NumberHelper::format($order->ship_fee) }}đ</td>
                    </tr>
                    <tr>
                        <th>Tổng cộng</th>
                        <td>{{ NumberHelper::format($order->totalPrice() + $order->ship_fee) }}đ</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-12 mt-4">
            <h4 class="fw-bold">Thông tin sản phẩm</h4>
            <div class="table-responsive">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>Sản phẩm</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Đơn giá</th>
                            <th class="text-center">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetails as $orderDetail)
                        <tr>
                            <td>
                                <div class="d-flex justify-content-start align-items-center gap-3">
                                    <img src="{{ $orderDetail->product->productImages->get(0)->link ?? '' }}" alt="" class="product-image">
                                    {{ $orderDetail->product->name }}
                                </div>
                            </td>
                            <td class="text-center">{{ $orderDetail->quantity }}</td>
                            <td class="text-center">{{ NumberHelper::format($orderDetail->price) }}đ</td>
                            <td class="text-center">{{ NumberHelper::format($orderDetail->price * $orderDetail->quantity) }}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
@stop