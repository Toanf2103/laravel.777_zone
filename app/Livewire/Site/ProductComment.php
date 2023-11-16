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
    public $comments;
    public $replyingId;
    public $commentContent;
    public $commentReplyContent;

    public function mount(Product $product, CommentService $commentService)
    {
        if (Auth::guard('user')->check()) {
            $this->userId = Auth::guard('user')->user()->id;
        }

        $this->product = $product;
        $this->comments = $commentService->getAll($product->id);
    }

    public function showAlert($title, $message, $type)
    {
        $this->dispatch('alertLogin', [
            'title' => $title,
            'mess' => $message,
            'icon' => $type
        ]);
    }

    public function replying($commentId)
    {
        $this->replyingId = $commentId;
    }

    public function loadDataComments()
    {
        $commentService = new CommentService();
        $this->comments = $commentService->getAll($this->product->id);
    }

    public function sendComment(CommentService $commentService)
    {
        if (!$this->userId) {
            $this->showAlert('Lỗi', 'Vui lòng đăng nhập', 'error');
            return;
        }

        if ($this->commentContent) {
            $commentService->create($this->product->id, $this->userId, $this->commentContent, null);
            $this->loadDataComments();
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
            $this->loadDataComments();
        }

        $this->commentReplyContent = '';
        $this->replyingId = null;
    }

    public function confirmDelete($commentId)
    {
        $this->dispatch('showConfirmDeleteComment', [
            'commentId' => $commentId
        ]);
    }

    public function deleteComment($commentId, CommentService $commentService)
    {
        if (!$this->userId) {
            $this->showAlert('Lỗi', 'Vui lòng đăng nhập', 'error');
            return;
        }

        $commentService->delete($commentId, $this->product->id);
        $this->loadDataComments();
    }

    public function render()
    {
        $this->comments = $this->comments->sortByDesc('id');
        return view('livewire.site.product-comment');
    }
}
