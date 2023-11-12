@extends('admin.layouts.main')

@section('title', 'Danh sách khách hàng - 777 Zone Admin')
@section('title-content', 'Danh sách khách hàng')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/customer/index.css') }}">
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Khách hàng</li>
@stop

@section('content')
<div class="d-flex flex-column gap-4">
    @if (session('success'))
    <div class="alert alert-success m-0">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle m-0">
            <thead class="table-secondary">
                <tr>
                    <th>Id</th>
                    <th>Ảnh đại diện</th>
                    <th>Họ và tên</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <th>{{ $customer->id }}</th>
                    <td>
                        <img src="{{ $customer->avatar ? $customer->avatar : 'https://storage.googleapis.com/laravel-img.appspot.com/user/default.png' }}" alt="" class="customer-avatar">
                    </td>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->phone_number }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->ward_id }}</td>
                    <td>
                        @if($customer->status)
                        <span class='badge bg-success'>Hoạt động</span>
                        @else
                        <span class='badge bg-danger'>Bị cấm</span>
                        @endif
                    </td>
                    <td>
                        <div class='d-flex justify-content-center align-items-center gap-2'>
                            @if($customer->status)
                            <button class='btn btn-danger' onclick="togglePostStatus('{{ $customer->id }}', true)" title="Khóa tài khoản">
                                <i class="fa-regular fa-lock"></i>
                            </button>
                            @else
                            <button class='btn btn-success' onclick="togglePostStatus('{{ $customer->id }}', false)" title="Mở khóa tài khoản">
                                <i class="fa-regular fa-lock-open"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $customers->withQueryString()->links('pagination::bootstrap-5') }}
</div>
@stop

@section('js')
<script>
    function togglePostStatus(id, isLock) {
        Swal.fire({
            title: "Bạn chắc chắn chứ?",
            text: `Bạn có thực sự muốn ${isLock ? 'khóa' : 'mở khóa'} tài khoản này không!`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya sure, chắc chắn rồi!",
            cancelButtonText: "Không bé ơi!",
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = `${rootURL}/admin/customers/${id}/toggleStatus`
            }
        });
    }
</script>
@stop