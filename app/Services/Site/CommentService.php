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

    public function create($productId, $userId, $content, $replyId)
    {
        Comment::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'content' => str()->ucfirst($content),
            'reply_id' => $replyId
        ]);

        event(new PostCommentEvent($productId));
    }

    public function delete($commentId, $productId)
    {
        Comment::find($commentId)->delete();

        event(new PostCommentEvent($productId));
    }
}
