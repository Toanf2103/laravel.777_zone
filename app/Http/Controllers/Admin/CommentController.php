<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Services\Site\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->middleware('admin');

        $this->commentService = $commentService;
    }

    public function index(Request $request)
    {
        $comments = Comment::orderBy('id', 'desc')
            ->whereHas('user', function ($query) {
                return $query->where('role', 'customer');
            });

        if ($request->product) {
            $comments = $comments->where('product_id', $request->product);
        }

        $comments = $comments->paginate(5);

        return view('admin.pages.comment.index', compact('comments'));
    }

    public function show($commentId)
    {
        $comment = Comment::where('id', $commentId)->first();

        return view('admin.pages.comment.show', compact('comment'));
    }

    public function delete($commentId)
    {
        Comment::find($commentId)->delete();

        return redirect()->back()->with('success', 'Xóa bình luận thành công');
    }

    public function deleteAllCommentByUser($userId)
    {
        $comments = Comment::where('user_id', $userId);
        $message = "Xóa tất cả bình luận của người dùng {$comments->get()[0]->user->full_name} thành công";
        $comments->delete();

        return redirect()->back()->with('success', $message);
    }
}
