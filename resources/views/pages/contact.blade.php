@extends('layouts.master')
@section('title', 'Contact')
    
@section('content')
<div class="wrapper">
    <div class="rte">
        <h1>Contact</h1>
    </div>

    <form method="POST" action="{{ route('contact') }}">
        @csrf
        <div class="form-fieldset">
            <input class="form-field {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" placeholder="Your e-mail">
        </div>
        <div class="form-fieldset">
            <input class="form-field {{ $errors->has('subject') ? ' is-invalid' : '' }}" type="text" name="subject" placeholder="Subject">
        </div>
        <div class="form-fieldset is-wide">
            <textarea class="form-textarea {{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" placeholder="Message"></textarea>
        </div>
        <button class="button">Send</button>
    </form>
</div>
@endsection