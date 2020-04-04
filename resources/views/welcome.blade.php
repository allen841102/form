@extends('layouts.app')

@section('content')

<div class="container">


    <div class="jumbotron bg-white">
        <h1 class="display-4"> 歡迎來到 {{ config('app.name') }}!</h1>
        <hr class="my-4">
        <p> 開始維護你的線上問券吧 !</p>
        <a class="btn btn-primary btn-lg btn-block" href="{{ route('login') }}" role="button">{{__('Login')}}</a>
    </div>
</div>
@endsection
