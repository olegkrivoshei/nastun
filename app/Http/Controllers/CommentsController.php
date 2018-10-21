<?php

namespace App\Http\Controllers;

use App\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comments;
        $comment->name = $request->input('name');
        $comment->body = $request->input('body');
        $comment->post_id = $request->input('post_id');
        $comment->save();

        return redirect('/post/'.$request->input('post_id'))->with('success', 'Comment created');

    }

}
