<?php

namespace App\Services\Site;

use App\Events\Site\PostCommentEvent;
use App\Models\Comment;

class CommentService
{
    public function getAll($productId)
    {
        return Comment::where('product_id', $productId)
            ->where('reply_id', null)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getById($commentId)
    {
        return Comment::find($commentId);
    }

    public function create($productId, $userId, $content, $replyId)
    {
        Comment::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'content' => str()->ucfirst(trim($content)),
            'reply_id' => $replyId
        ]);

        event(new PostCommentEvent($productId, $replyId, $userId));
    }

    public function delete($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete();

        event(new PostCommentEvent($comment->product->id, $comment->reply_id ?? $comment->id, $comment->user->id));
    }
}
