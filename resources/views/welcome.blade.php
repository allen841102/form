@extends('layouts.app')

@section('content')

<div class="container">

    <div class="jumbotron">
        <h1 class="display-4"> 歡迎來到 {{ config('app.name') }}!</h1>
        <p class="lead"> 這是一個線上問券研究的 Side Project，後端用 PHP 框架 Laravel，前端用 Vue 框架 Element UI </p>
        <hr class="my-4">
        <p> 登入以開始維護你的線上問券吧 !</p>
        <a class="btn btn-primary btn-lg btn-block" href="{{ route('login') }}" role="button">{{__('Login')}}</a>
    </div>
</div>
@endsection
