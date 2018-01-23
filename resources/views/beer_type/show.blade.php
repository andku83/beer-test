@extends('layouts.default')
@section('content')
    <h2>Beer Type view {{ $model->name }}</h2>
    <ul>
        <li>Name: {{ $model->name }}</li>
    </ul>
    <a class="btn btn-success" href="{{ action('BeerTypeController@edit', ['id' => $model->id]) }}">Edit</a>
@stop
