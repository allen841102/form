@extends('layouts.admin')
<?php
    $headerText = " 問券主題 回覆詳情";
?>

@section('title', '建立問券')

@section('content')
    <survey-details :survey="{{ $survey }}"></survey-details>
@endsection
