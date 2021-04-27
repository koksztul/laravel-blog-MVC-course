@extends('layouts.master')
@section('title', 'Verify your email')

@section('content')
<div class="wrapper">
    <div class="rte">
        <h1>Verify your email</h1>
    </div>
    <div class="rte mt">
        <p>Didn't get and email? <a href="{{ route('verification.resend') }}">Request another.</a></p>
    </div>
</div>
@endsection