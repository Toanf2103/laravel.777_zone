<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\Site\CommentService;

class Comment extends Component
{
    public $commentId;
    public $productId;
    public $userId;
    public $commentReplyContent;

    public function mount($comment)
    {
        if ($comment) {
            $this->commentId = $comment->id;
            $this->userId = Auth::guard('admin')->user()->id;
            $this->productId = $comment->product->id;
        }
    }

    public function reRender()
    {
        // Gọi hàm này cho zui, chủ yếu để chạy hàm render()
        return;
    }

    public function showAlert($title, $message, $type)
    {
        $this->dispatch('alertLogin', [
            'title' => $title,
            'mess' => $message,
            'icon' => $type
        ]);

        $this->skipRender();
    }

    public function sendCommentReply(CommentService $commentService)
    {
        if ($this->commentReplyContent) {
            $commentService->create($this->productId, $this->userId, $this->commentReplyContent, $this->commentId);
        }

        $this->commentReplyContent = '';
    }

    public function confirmDelete($commentId)
    {
        $this->dispatch('showConfirmDeleteComment', [
            'commentId' => $commentId
        ]);

        $this->skipRender();
    }

    public function deleteComment($commentId, CommentService $commentService)
    {
        $commentService->delete($commentId);
    }

    public function render()
    {
        $commentService = new CommentService();

        return view('livewire.admin.comment', [
            'comment' => $this->commentId ? $commentService->getById($this->commentId) : null
        ]);
    }
}
