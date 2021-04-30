@extends('layouts.master')
@section('title', 'Create new post')

@section('content')
<div class="wrapper">
    <div class="rte">
        <h1>Create new post</h1>
    </div>

    <form action="{{ route('admin.post.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-fieldset">
            <input class="form-field" type="text" name="title" placeholder="Title">
        </div>
        <div class="form-fieldset">
            <div class="form-select">
                <select name="type">
                    <option value="" disabled selected>Choose Type</option>
                    <option value="text">Type: Text</option>
                    <option value="photo">Type: Photo</option>
                </select>
            </div>
        </div>
        <div class="form-fieldset">
            <label class="form-label">Date:</label>
            <input class="form-field {{ $errors->has('date') ? ' is-invalid' : '' }}" type="date" name="date">
        </div>
        <div class="form-fieldset">
            <label class="form-label">Tags:</label>
            <input class="form-field" type="text" name="tags">
        </div>
        <div class="form-fieldset">
            <label class="form-label">Published:</label>
            <input type="checkbox" name="published" value="1">
        </div>
        <div class="form-fieldset">
            <label class="form-label">Premium:</label>
            <input type="checkbox" name="premium" value="1">
        </div>
        <div class="form-fieldset">
            <label class="form-label">Image:</label>
            <input type="file" name="image">
        </div>
        <div class="form-fieldset is-full">
            <textarea id="wysiwyg" class="form-textarea" name="content" placeholder="Content"></textarea>
        </div>
        <button class="button">Add post</button>
    </form>

</div>
@endsection

@section('footer_scripts')
    <script src="{{ mix('/js/main.js') }}"></script>
@endsection