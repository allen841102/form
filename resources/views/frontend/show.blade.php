<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $survey->name }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        body{
            font-family: "Helvetica Neue",Helvetica,"PingFang SC","Hiragino Sans GB","Microsoft YaHei","微软雅黑",Arial,sans-serif;
            margin: 0;
        }
        </style>
</head>
<body>
<div id="app">
    <el-image
            src="/images/survey.jpeg"
            style="max-height: 400px;"
            fit="scale-down"
    >
    </el-image>
    <survey-reply :survey="{{$survey->toJson()}}"></survey-reply>
</div>
</body>
</html>
