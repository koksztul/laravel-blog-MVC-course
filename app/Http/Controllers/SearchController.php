<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $posts = Post::published()
            ->where('title', 'LIKE', '%' . $q . '%')
            ->orWhere('content', 'LIKE', '%' . $q . '%')
            ->paginate(3);

        $posts->appends(['q' => $q]);

        return view('pages.posts', compact('posts'));
    }
}
