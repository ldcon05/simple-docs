@extends('layouts.app')

@section('content')
<h1 class="text-center mt-3">Create Document</h1>
<form action="/documents" method="POST" id="create-doc" class="mt-3 mb-3">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="name">Tags</label>
        <input type="text" class="form-control" name="tags" placeholder="tag1, tag2">
        <small class="form-text text-muted">Separate the tags by comma.</small>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        @if ($type === 'text')
            <input type='hidden' class="form-control" name="description" ></textarea>
            <div id="editor">
            </div>
        @else
            <textarea class="form-control" placeholder="Enter Description" id="description" name="description" ></textarea>
        @endif
    </div>
    <input type="hidden" class="form-control" name="format" value="{{$type}}">
    <button type="submit" class="btn btn-outline-primary">Create Document</button>
</form>

@include('documents.editor.'.$type)


@endsection
