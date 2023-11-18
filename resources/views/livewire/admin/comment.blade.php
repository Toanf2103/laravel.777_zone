@php
use App\Helpers\DateHelper
@endphp

<div class="comment-product-content">
    @if($comment)
    <div class="d-flex flex-column gap-3">
        <div class="comment-item d-flex align-items-start justify-content-start gap-3">
            <div class="avatar">
                <img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->full_name }}">
            </div>
            <div class="comment-item-content">
                <div class="comment-name">
                    <p>{{ $comment->user->full_name }}</p>
                </div>
                <div class="comment-content">
                    <span>{{ $comment->content }}</span>
                </div>
                <div class="comment-time d-flex align-items-center justify-content-start gap-3">
                    <span>{{ DateHelper::formatTimeAgo($comment->created_at) }}</span>
                    @if($userId == $comment->user_id)
                    <i class="fa-duotone fa-circle"></i>
                    <button type="button" wire:click="confirmDelete({{ $comment->id }})">Xóa</button>
                    @endif
                </div>
            </div>
        </div>

        @foreach($comment->replies as $commentReply)
        <div class="comment-item d-flex align-items-start justify-content-start gap-3 comment-replay">
            <div class="avatar">
                <img src="{{ $commentReply->user->avatar }}" alt="{{ $commentReply->user->full_name }}">
            </div>
            <div class="comment-item-content">
                <div class="comment-name">
                    <p>{{ $commentReply->user->full_name }}</p>
                </div>
                <div class="comment-content">
                    <span>{{ $commentReply->content }}</span>
                </div>
                <div class="comment-time d-flex align-items-center justify-content-start gap-3">
                    <span>{{ DateHelper::formatTimeAgo($commentReply->created_at) }}</span>
                    @if($userId == $commentReply->user_id)
                    <i class="fa-duotone fa-circle"></i>
                    <button type="button" wire:click="confirmDelete({{ $commentReply->id }})">Xóa</button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

        <form class="form-comment send-replay mt-4" wire:submit="sendCommentReply">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model="commentReplyContent"></textarea>
            <div class="d-flex justify-content-end mt-4">
                <button type="submit">Gửi phản hồi</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('livewire:initialized', function(e) {
            const component = window.Livewire.find(document.querySelector('.comment-product-content').getAttribute('wire:id'));

            // Event confirm delete
            document.addEventListener('showConfirmDeleteComment', (e) => {
                const commentId = e.detail[0].commentId

                Swal.fire({
                    title: "Bạn chắc chứ",
                    text: "Bạn có chắc muốn xóa bình luận này không?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya sure, chắc chắn rồi",
                    cancelButtonText: "Không bé ơi"
                }).then((result) => {
                    if (result.isConfirmed) {
                        component.deleteComment(commentId)
                    }
                });
            })

            // Event pusher
            Pusher.logToConsole = false;
            var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                cluster: 'ap1'
            });
            var channel = pusher.subscribe('comment-{{ $commentId }}');
            channel.bind('comment-update', function(data) {
                if (data.userSend != '{{ $userId }}') {
                    component.reRender()
                }
            });
        })
    </script>
    @else
    <div class="alert alert-danger">
        Bình luận không tồn tại hoặc đã bị xóa!
    </div>
    @endif
</div>