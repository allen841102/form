<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <style>
        body{
            font-family: "Helvetica Neue",Helvetica,"PingFang SC","Hiragino Sans GB","Microsoft YaHei","微软雅黑",Arial,sans-serif;
        }
    </style>
</head>
<body>

<div id="app">
    <el-container style="height: auto; border: 1px solid #eee">
        <side-bar home-page="{{route('dashboard')}}" creation-link="{{ route('survey.create') }}"></side-bar>
        <el-container direction="vertical">
            <nav-header></nav-header>
            <el-main>
                @yield('content')
            </el-main>
        </el-container>
    </el-container>
</div>
<script src="{{ mix('admin-js/admin.js') }}"></script>
@yield('script')
</body>
</html>

