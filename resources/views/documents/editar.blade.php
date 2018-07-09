@extends('layouts.app')

@section('content')
<h1 class="text-center mt-3">Edit Document</h1>

<div id="reviews" class="container row">
    @foreach($allDocument[1] as $document)
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Version - {{ $document->id }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $document->created_at }}</h6>
                    <a href="#" class="card-link view-document">ver</a>
                    <input type="hidden" value="{{ $document-> id }}">
                </div>
            </div>
        </div>
    @endforeach
</div>

<form action="/documents/{{$allDocument[0]->id}}" method="POST" id="create-doc" class="mt-3 mb-3">
    @method('PUT')
    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" value="{{$allDocument[0]->title}}" name="name" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="name">Tags</label>
        <input type="text" class="form-control" value="{{$allDocument[0]->tags}}" name="tags" placeholder="tag1, tag2">
        <small class="form-text text-muted">Separate the tags by comma.</small>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        @if ($allDocument[0]->format === 'text')
            <input type='hidden' class="form-control" value="{{$allDocument[0]->body}}" name="description" ></textarea>
            <div id="editor">
                
            </div>
        @else
            <textarea class="form-control" placeholder="Enter Description" id="description" name="description" >{{$allDocument[0]->body}}</textarea>
        @endif
    </div>
    <button type="submit" class="btn btn-outline-primary">Update Document</button>
    <button id="cancel" type="button" class="btn btn-outline-primary d-none">Cancel</button>
</form>

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
        title =  document.querySelector('input[name=name]').value;
        tags =  document.querySelector('input[name=tags]').value;
        //body = simplemde.value();
        body = document.querySelector("#editor .ql-editor").innerHTML;
        
        var id = $(this).siblings('input').val();
        $.get( "/reviews/" + id , function( data ) {
            asignValue('name', data.title);
            asignValue('tags', data.tags);
            document.querySelector("#editor .ql-editor").innerHTML = data.body;
          //  simplemde.value(data.body)
        });
    });

    $('#cancel').click(function() {
        $('#cancel').addClass('d-none');
        asignValue('name', title);
        asignValue('tags', tags);
        //simplemde.value(body)
        document.querySelector("#editor .ql-editor").innerHTML = body;
    })


</script>

@endsection
