@extends('layouts.app')

@section('content')
<h1 class="text-center mt-3">Create Document</h1>

{!! Form::open(['route' => 'documents.store', 'method' => 'POST', 'id' => 'create-doc']) !!}
    
    @component('documents.components.form')
        @if ($type === 'text')
            {!! Form::hidden('body', null)!!}
            <div id="editor">
            </div>
        @else
            {!! Form::textarea('body', null, ['placeholder' => 'Enter Text', 'class' => 'form-control', 'id' => 'body'])!!}
        @endif
    @endcomponent

    {!! Form::hidden('format', $type)!!}
    {!! Form::submit('Save', ['class' => 'btn btn-outline-primary '])!!}
{!! Form::close() !!}

@include('documents.editor.'.$type)


@endsection
