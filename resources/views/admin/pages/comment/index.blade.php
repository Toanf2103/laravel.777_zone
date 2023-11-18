@php
use App\Helpers\DateHelper
@endphp

@extends('admin.layouts.main')

@section('title', 'Danh sách bình luận - 777 Zone Admin')
@section('title-content', 'Danh sách bình luận')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/comment/index.css') }}">
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Bình luận</li>
@stop

@section('content')
<div class="d-flex flex-column gap-4">
    @if (session('success'))
    <div class="alert alert-success m-0">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        @if($comments->count() ==0)
        <table class="table align-middle m-0">
            <tr>
                <td>
                    <h4>Danh sách bình luận trống</h4>
                </td>
            </tr>
        </table>
        @else
        <table class="table table-hover align-middle m-0">
            <thead class="table-secondary">
                <tr>
                    <th>Id</th>
                    <th>Trả lời cho bình luận</th>
                    <th>Sản phẩm</th>
                    <th>Người bình luận</th>
                    <th>Nội dung</th>
                    <th>Ngày tạo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                <tr>
                    <th>{{ $comment->id }}</th>
                    <td>{{ $comment->commentParent->content ?? '' }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $comment->product->productImages->get(0)->link ?? '' }}" alt="" class="product-image">
                            <span class="text-start">{{ $comment->product->name }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $comment->user->avatar ?? 'https://storage.googleapis.com/laravel-img.appspot.com/user/customer-default.png' }}" alt="" class="user-avatar">
                            <span class="text-start">{{ $comment->user->full_name }} {{ !$comment->user->status ? '(Tài khoản bị cấm)' : '' }}</span>
                        </div>
                    </td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ DateHelper::convertDateFormat($comment->created_at) }}</td>
                    <td>
                        <div class='d-flex justify-content-center align-items-center gap-2'>
                            <a href="{{ route('admin.comments.show', ['comment' => $comment->reply_id ?? $comment->id]) }}" class='btn btn-success' onclick="" title="Xem chi tiết bình luận">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            <button class='btn btn-danger' onclick="deleteComment('{{ $comment->id }}')" title="Xóa bình luận">
                                <i class="fa-regular fa-trash"></i>
                            </button>
                            <button class='btn btn-danger' onclick="deleteAllCommentByUser('{{ $comment->user_id }}', '{{ $comment->user->full_name }}')" title="Xóa tất cả bình luận của người dùng này">
                                <i class="fa-regular fa-trash-xmark"></i>
                            </button>
                            @if($comment->user->status)
                            <button class='btn btn-danger' onclick="banUser('{{ $comment->user_id }}')" title="Khóa tài khoản người dùng này">
                                <i class="fa-regular fa-ban"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    {{ $comments->withQueryString()->links('pagination::bootstrap-5') }}
</div>
@stop

@section('js')
<script>
    function deleteComment(id) {
        Swal.fire({
            title: "Bạn chắc chắn chứ?",
            text: `Bạn có thực sự muốn xóa bình luận này không!`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya sure, chắc chắn rồi!",
            cancelButtonText: "Không bé ơi!",
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = `${rootURL}/admin/comments/${id}/delete`
            }
        });
    }

    function deleteAllCommentByUser(userId, userName) {
        Swal.fire({
            title: "Bạn chắc chắn chứ?",
            text: `Bạn có thực sự muốn xóa tất cả bình luận của ${userName} không!`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya sure, chắc chắn rồi!",
            cancelButtonText: "Không bé ơi!",
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = `${rootURL}/admin/comments/${userId}/delete-all-comment-by-user`
            }
        });
    }

    function banUser(id) {
        Swal.fire({
            title: "Bạn chắc chắn chứ?",
            text: `Bạn có thực sự muốn khóa tài khoản người dùng này không!`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya sure, chắc chắn rồi!",
            cancelButtonText: "Không bé ơi!",
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = `${rootURL}/admin/customers/${id}/toggle-status`
            }
        });
    }
</script>
@stop