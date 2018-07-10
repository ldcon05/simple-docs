@extends('layouts.app')

@section('content')
    <h1>Author: {{$document->user->name}}</h1>
    <h1>{{$document}}</h1>
@endsection
