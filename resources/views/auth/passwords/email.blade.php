@extends('layouts.master')
@section('title', 'Reset Password')

@section('content')
<div class="wrapper">
    <div class="rte">
        <h1>Reset Password</h1>
    </div>

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="form-fieldset">
            <input class="form-field {{ $errors->has('email') ? ' is-invalid' : ''}}" type="email" name="email" placeholder="Your e-mail">
        </div>
        <button class="button">Submit</button>
    </form>
</div>
@endsection