@extends('layouts.admin')

<?php
$headerText = '請小心修改，刪除的內容，送出後就回不來了';
?>

@section('title', '編輯問券')

@section('content')
    <survey-creation :user-survey="{{ $survey }}"></survey-creation>
@endsection
