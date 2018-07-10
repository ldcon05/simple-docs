@extends('layouts.app')

@section('content')

<h1 class="text-center mt-3">Edit Document</h1>

@include('reviews.reviews_document')

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

    {!! Form::submit('Update', ['class' => 'btn btn-outline-primary '])!!}
{!! Form::close() !!}


@include('documents.editor.'.$allDocument[0]->format)


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

    var title = '';
    var tags = '';
    var body = '';

    function asignValue(element, newValue) {
        document.querySelector(`input[name=${element}]`).value = newValue;
    }

    $( ".view-document" ).click(function(e) {    
        $('#cancel').removeClass('d-none');
        title =  document.querySelector('input[name=title]').value;
        tags =  document.querySelector('input[name=tags]').value;
        //body = simplemde.value();
        body = document.querySelector("#editor .ql-editor").innerHTML;
        
        var id = $(this).siblings('input').val();
        $.get( "/reviews/" + id , function( data ) {
            asignValue('title', data.title);
            asignValue('tags', data.tags);
            document.querySelector("#editor .ql-editor").innerHTML = data.body;
          //  simplemde.value(data.body)
        });
    });

    $('#cancel').click(function() {
        $('#cancel').addClass('d-none');
        asignValue('title', title);
        asignValue('tags', tags);
        //simplemde.value(body)
        document.querySelector("#editor .ql-editor").innerHTML = body;
    })


</script>

@endsection
