<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:manage-posts');
    }

    protected function validator($data)
    {
        $validated =  Validator::make($data, [
            'title' => 'required|max:255',
            'type' => 'required|in:text,photo',
            'date' => 'nullable|date',
            'image' => 'nullable|image|max:1024',
            'content' => 'nullable',
            'published' => 'boolean',
            'premium' => 'boolean'
        ])->validate();
        $validated = Arr::add($validated, 'published', 0);
        $validated = Arr::add($validated, 'premium', 0);

        return $validated;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('manage-posts');
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validator($request->all());
        if (isset($data['image'])) {
            $path = $request->file('image')->store('photos');
            $data['image'] = $path;
        }
        $data['user_id'] = $request->user()->id;

        $post = Post::create($data);

        session()->flash('message', 'Post has been added!');

        return redirect(route('posts.single', $post->slug));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::FindOrFail($id);
        $oldImage = $post->image;
        $data = $this->validator($request->all());
        if (isset($data['image'])) {
            $path = $request->file('image')->store('photos');
            $data['image'] = $path;
        }
        $post->update($data);
        if (isset($data['image'])) {
            Storage::delete($oldImage);
        }
        return back()->with('message', 'Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::FindOrFail($id);

        $post->delete();

        Storage::delete($post->image);

        return redirect('/')->with('message', 'Post has been deleted');
    }
}
