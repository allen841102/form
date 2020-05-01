@extends('layouts.admin')
<?php
    $headerText = $survey->name;
?>

@section('title', '建立問券')

@section('content')
    <survey-details tab="review"></survey-details>
@endsection
