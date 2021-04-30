<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::query()
            ->where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('content', 'LIKE', '%' . $search . '%')
            ->paginate(3);

        return view('pages.posts', compact('posts'));
    }
}
