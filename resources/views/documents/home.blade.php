@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center mt-5 mb-3">
        <a href='create/text' class="btn btn-outline-primary mr-2 ">Create Text Document</a>
        <a href='create/md' class="btn btn-outline-secondary">Create MD Document</a>
    </div>
    <div class="row documents">
        @foreach($documents as $document)
            <div class="col-xl-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $document->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $document->created_at }}</h6>
                        <a href="/ver/document/{{ $document->id }}" class="card-link" target="_blank">Ver</a>
                        <a href="/documents/{{ $document->id }}/edit" class="card-link">Edit</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection