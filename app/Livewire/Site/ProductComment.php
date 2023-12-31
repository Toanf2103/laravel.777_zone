<?php

namespace App\Livewire\Site;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Services\Site\CommentService;

class ProductComment extends Component
{
    public $product;
    public $userId;
    public $replyingId;
    public $commentContent;
    public $commentReplyContent;

    public function mount(Product $product)
    {
        if (Auth::guard('user')->check()) {
            $this->userId = Auth::guard('user')->user()->id;
        }

        $this->product = $product;
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

    public function replying($commentId)
    {
        $this->replyingId = $commentId;
    }

    public function sendComment(CommentService $commentService)
    {
        if (!$this->userId) {
            $this->showAlert('Lỗi', 'Vui lòng đăng nhập', 'error');
            return;
        }

        if ($this->commentContent) {
            $commentService->create($this->product->id, $this->userId, $this->commentContent, null);
        }

        $this->commentContent = '';
    }

    public function sendCommentReply($commentId, CommentService $commentService)
    {
        if (!$this->userId) {
            $this->showAlert('Lỗi', 'Vui lòng đăng nhập', 'error');
            return;
        }

        if ($this->commentReplyContent) {
            $commentService->create($this->product->id, $this->userId, $this->commentReplyContent, $commentId);
        }

        $this->commentReplyContent = '';
        $this->replyingId = null;
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
        if (!$this->userId) {
            $this->showAlert('Lỗi', 'Vui lòng đăng nhập', 'error');
            return;
        }

        $commentService->delete($commentId);
    }

    public function render()
    {
        $commentService = new CommentService();

        return view('livewire.site.product-comment', [
            'comments' => $commentService->getAll($this->product->id)
        ]);
    }
}
