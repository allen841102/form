@extends('layouts.admin')
<?php
$headerText = $survey->name;
?>

@section('title', '查看結果')

@section('content')
    <survey-details tab="share" :survey="{{ $survey->toJson() }}"></survey-details>
@endsection
