@php
use App\Helpers\NumberHelper;
@endphp

@extends('admin.layouts.main')

@section('title', 'Chi tiết đơn hàng - 777 Zone Admin')
@section('title-content', 'Chi tiết đơn hàng')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/customer/index.css') }}">
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

    <h4 class="fw-bold">Thông tin khách hàng</h4>
    <div class="table-responsive">
        <table class="table table-hover align-middle m-0">
            <thead class="table-secondary">
                <tr>
                    <th>Họ và tên</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone_number }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order['full_address'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr class="my-5">

    <h4 class="fw-bold">Thông tin sản phẩm</h4>
    <div class="table-responsive">
        <table class="table table-hover align-middle m-0">
            <thead class="table-secondary">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderDetails as $orderDetail)
                <tr>
                    <td>{{ $orderDetail->product->name }}</td>
                    <td>{{ $orderDetail->quantity }}</td>
                    <td>{{ NumberHelper::format($orderDetail->price) }}đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <hr class="my-5">

    <h4 class="fw-bold">Thông tin đơn hàng</h4>
    <div class="table-responsive">
        <table class="table table-bordered align-middle m-0">
            <tr>
                <th class="text-start">Phương thức thanh toán</th>
                <td class="text-start">{{ $order->pay_method }}</td>
            </tr>
            <tr>
                <th class="text-start">Pay id</th>
                <td class="text-start">{{ $order->pay_id }}</td>
            </tr>
            <tr>
                <th class="text-start">Trạng thái thanh toán</th>
                <td class="text-start">{{ $order->pay_status ? 'Đã thanh toán' : 'Chưa thanh toán' }}</td>
            </tr>
            <tr>
                <th class="text-start">Trạng thái đơn hàng</th>
                <td class="text-start">
                    @if($order->status == 'waiting')
                    Đang chờ duyệt
                    @elseif($order->status == 'approved')
                    Đã duyệt
                    @elseif($order->status == 'shipping')
                    Đang giao hàng
                    @elseif($order->status == 'completed')
                    Giao hàng thành công
                    @elseif($order->status == 'cancel')
                    Đã hủy
                    @endif
                </td>
            </tr>
            <tr>
                <th class="text-start">Tổng giá sản phẩm</th>
                <td class="text-start">{{ NumberHelper::format($order->totalPrice()) }}đ</td>
            </tr>
            <tr>
                <th class="text-start">Phí vận chuyển</th>
                <td class="text-start">{{ NumberHelper::format($order->ship_fee) }}đ</td>
            </tr>
            <tr>
                <th class="text-start">Tổng cộng</th>
                <td class="text-start">{{ NumberHelper::format($order->totalPrice() + $order->ship_fee) }}đ</td>
            </tr>
        </table>
    </div>

    <hr class="my-5">
</div>
@stop

@section('js')
@stop