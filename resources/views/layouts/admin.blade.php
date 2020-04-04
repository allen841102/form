<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
</head>
<body>

<div id="app">
    <el-container style="height: auto; border: 1px solid #eee">
        <side-bar></side-bar>
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

