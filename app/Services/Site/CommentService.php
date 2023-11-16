<?php

namespace App\Services\Site;

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
            'content' => $content,
            'reply_id' => $replyId
        ]);
    }

    public function delete($commentId)
    {
        Comment::find($commentId)->delete();
    }
}
