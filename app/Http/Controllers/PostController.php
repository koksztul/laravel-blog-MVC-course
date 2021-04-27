<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller\abrot;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()->latest('date')->paginate(3);

        return view('pages.posts', compact('posts'));
    }
    public function show($slug)
    {
        $post = Post::published()->whereSlug($slug)->firstOrFail();
        return view('pages.post', compact('post'));
    }
}
