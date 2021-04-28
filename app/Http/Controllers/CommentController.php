<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Arr;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required|numeric|exists:posts,id',
            'content' => 'required|min:3'
        ]);
            Comment::create(Arr::add($data, 'user_id', $request->user()->id));

        return back()->with('message', 'Your comment has beed added!');
    }
}
