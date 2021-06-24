<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests\CommentFormRequest;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function newComment(CommentFormRequest $request)
    {

        if(!Auth::check())
        {
            return redirect('users/login');
        } 
        else
        {
            $comment = new Comment(array(
                'post_id' => $request->get('post_id'),
                'content' => $request->get('content'),
                'post_type' => $request->get('post_type')
            ));
    
            $comment->save();
            return redirect()->back()->with('status', 'Your comment has been created!');
        }
    }
}
