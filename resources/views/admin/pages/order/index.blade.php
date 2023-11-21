@extends('admin.layouts.main')

@section('title', 'Danh sách đơn hàng - 777 Zone Admin')
@section('title-content', 'Danh sách đơn hàng')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/customer/index.css') }}">
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
@stop

@section('content')
<div class="d-flex flex-column gap-4">
    <form>
        <div class="d-flex flex-wrap justify-content-start algin-items-center gap-2 gap-md-3">
            <div class="col-12 col-md-auto">
                <select name="pay_method" class="form-select">
                    <option value="">Phương thức thanh toán</option>
                    <option value="cod" {{ request()->input('pay_method') === 'cod' ? 'selected' : ''  }}>CoD</option>
                    <option value="vnpay" {{ request()->input('pay_method') === 'vnpay' ? 'selected' : ''  }}>Vnpay</option>
                    <option value="momo" {{ request()->input('pay_method') === 'momo' ? 'selected' : ''  }}>Momo</option>
                </select>
            </div>
            <div class="col-12 col-md-auto">
                <select name="pay_status" class="form-select">
                    <option value="">Trạng thái thanh toán</option>
                    <option value="1" {{ request()->input('pay_status') === '1' ? 'selected' : ''  }}>Đã thanh toán</option>
                    <option value="0" {{ request()->input('pay_status') === '0' ? 'selected' : ''  }}>Chưa thanh toán</option>
                </select>
            </div>
            <div class="col-12 col-md-auto">
                <select name="status" class="form-select">
                    <option value="">Trạng thái đơn hàng</option>
                    <option value="waiting" {{ request()->input('status') === 'waiting' ? 'selected' : ''  }}>Đang chờ duyệt</option>
                    <option value="approved" {{ request()->input('status') === 'approved' ? 'selected' : ''  }}>Đã duyệt</option>
                    <option value="shipping" {{ request()->input('status') === 'shipping' ? 'selected' : ''  }}>Đang giao hàng</option>
                    <option value="completed" {{ request()->input('status') === 'completed' ? 'selected' : ''  }}>Giao hàng thành công</option>
                    <option value="cancel" {{ request()->input('status') === 'cancel' ? 'selected' : ''  }}>Đã hủy</option>
                </select>
            </div>
            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary gap-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Tìm kiếm</span>
                </button>
            </div>
            <div class="col-md-auto">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-info gap-2">
                    <i class="fa-solid fa-rotate"></i>
                    <span>Làm mới</span>
                </a>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle m-0">
            <thead class="table-secondary">
                <tr>
                    <th>Id</th>
                    <th>Khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Phương thức thanh toán</th>
                    <th>Pay id</th>
                    <th>Trạng thái thanh toán</th>
                    <th>Phí vận chuyển</th>
                    <th>Trạng thái đơn hàng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <th>{{ $order->id }}</th>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone_number }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order['full_address'] }}</td>
                    <td>{{ $order->pay_method }}</td>
                    <td>{{ $order->pay_id }}</td>
                    <td>
                        @if($order->pay_status)
                        <span class='badge bg-success'>Đã thanh toán</span>
                        @else
                        <span class='badge bg-secondary'>Chưa thanh toán</span>
                        @endif
                    </td>
                    <td>{{ $order->ship_fee }}</td>
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
                    <td>
                        <div class='d-flex justify-content-center align-items-center gap-2'>
                            <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}" class='btn btn-info' title="Xem chi tiết đơn hàng">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $orders->withQueryString()->links('pagination::bootstrap-5') }}
</div>
@stop

@section('js')
@stop