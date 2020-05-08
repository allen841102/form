<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", Arial, sans-serif;
        }
    </style>
</head>
<body>

<div id="app">

    <el-container style="border: 1px solid #eee">
        <side-bar
            home-page="{{route('dashboard')}}"
            creation-link="{{ route('survey.create') }}"
            username="{{auth()->user()->name}}"
            csrf-token="{{ csrf_token() }}"
        ></side-bar>
        <el-container style="height: auto;">
            <el-container direction="vertical">
                <nav-header header-text="{{ $headerText ?? '歡迎來到後台管理介面' }}"></nav-header>
                <el-main>
                    @yield('content')
                </el-main>
            </el-container>
        </el-container>
    </el-container>
</div>
<script src="{{ mix('admin-js/admin.js') }}"></script>
@yield('script')
</body>
</html>

