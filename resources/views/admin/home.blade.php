@extends('layouts.admin')

@section('title', '管理介面')

@section('content')
    <survey-table survey-list="{{ $list }}"></survey-table>
@endsection
