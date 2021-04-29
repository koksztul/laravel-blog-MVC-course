@extends('layouts.master')
@section('title', 'Edit post')

@section('content')
<div class="wrapper">
    <div class="rte">
        <h1>Editpost</h1>
    </div>

    <form action="{{ route('admin.post.edit', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-fieldset">
            <input class="form-field" type="text" name="title" placeholder="Title" value="{{ $post->title }}">
        </div>
        <div class="form-fieldset">
            <div class="form-select" {{ $errors->has('type') }}>
                <select name="type"> 
                    <option value="text"{{ $post->type == 'text' ? ' selected' : ''}} selected>Type: Text</option>
                    <option value="photo" {{ $post->type == 'photo' ? ' selected' : ''}}>Type: Photo</option>     
                </select>
            </div>
        </div>
        <div class="form-fieldset">
            <label class="form-label">Date:</label>
            <input class="form-field {{ $errors->has('date') }}" type="date" name="date" value="{{ $post->date->format('Y-m-d')}}">
        </div>
        <div class="form-fieldset">
            <label class="form-label">Tags:</label>
            <input class="form-field {{ $errors->has('tags') }}" type="text" name="tags" value="{{ $post->tags->implode('name', ' ') }}">
        </div>
        <div class="form-fieldset">
            <label class="form-label">Published:</label>
            <input type="checkbox" name="published" value="1"{{ $post->published ? ' checked' : ''}}>
        </div>
        <div class="form-fieldset">
            <label class="form-label">Premium:</label>
            <input type="checkbox" name="premium" value="1"{{ $post->premium ? ' checked' : ''}}>
        </div>
        <img src="{{ $post->photo }}" alt="" class="form-image">
        <div class="form-fieldset">
            <label class="form-label">Image:</label>
            <input type="file" name="image">
        </div>
        <div class="form-fieldset is-full">
            <textarea id="wysiwyg" class="form-textarea" name="content" placeholder="Content">{{ $post->content }}</textarea>
        </div>
        <button class="button">Edit post</button>
    </form>
    <div class="rte mt">
        <h1>Delete post</h1>
    </div>

    <form action="{{ route('admin.post.delete', $post->id) }}" method="POST">
        @csrf
        {{ method_field('DELETE')}}
        <button class="button button--danger" onclick="return confirm('Are u sure?')">Delete post</button>
    </form>
</div>
@endsection