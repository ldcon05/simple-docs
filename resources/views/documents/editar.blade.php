@extends('layouts.app')

@section('content')

<h1 class="text-center mt-3">Edit Document</h1>

@include('reviews.reviews_document')
<a href="/download/document/{{$allDocument[0]->id}}" class="card-link" target="_blank">Download</a>


{!! Form::model($allDocument[0], ['route' => ['documents.update', $allDocument[0]], 'method' => 'PUT', 'id' => 'create-doc', 'class' => 'mt-3 mb-3' ]) !!}
    @component('documents.components.form')
        @if ($allDocument[0]->format === 'text')
            {!! Form::hidden('body', null)!!}
            <div id="editor">
            </div>
        @else
            {!! Form::textarea('body', null, ['placeholder' => 'Enter Text', 'class' => 'form-control', 'id' => 'body'])!!}
        @endif
    @endcomponent
    {!! Form::hidden('format', $allDocument[0]->format)!!}
    {!! Form::submit('Update', ['class' => 'btn btn-outline-primary '])!!}
{!! Form::close() !!}


@include('documents.editor.'.$allDocument[0]->format)


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    function asignValue(element, newValue) {
        document.querySelector(`input[name=${element}]`).value = newValue;
    }

    function getTextEditor() {
        if(document.querySelector("#editor") == null )
            simplemde.value();
        else 
            document.querySelector("#editor .ql-editor").innerHTML
    }

    function setTextEditor(value) {
        if(document.querySelector("#editor") == null)
            simplemde.value(value);
        else 
            document.querySelector("#editor .ql-editor").innerHTML = value 
    }
 

    $( ".view-document" ).click(function(e) {    
        var id = $(this).siblings('input').val();
        $.get( "/reviews/" + id , function( data ) {
            asignValue('title', data.title);
            asignValue('tags', data.tags);
            setTextEditor(data.body)
        });
    });


</script>

@endsection
