<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;

class TagController extends Controller
{
    public function index($slug)
    {
        $posts = Post::published()
        ->whereHas('tags', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })
        ->latest('date')
        ->paginate(3);

        return view('pages.posts', compact('posts'));
    }
}
