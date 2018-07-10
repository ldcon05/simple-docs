@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center mt-5 mb-3">
        <a href='create/text' class="btn btn-outline-primary mr-2 ">Create Text Document</a>
        <a href='create/md' class="btn btn-outline-secondary">Create MD Document</a>
    </div>

    @include('documents.components.filter');

    <div class="row documents">
        @foreach($documents as $document)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $document->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $document->created_at }}</h6>
                        <a href="/ver/document/{{ $document->id }}" class="card-link" target="_blank">Ver</a>
                        <a href="/documents/{{ $document->id }}/edit" class="card-link">Edit</a>
                        <a href="/shared/document/{{ $document->id }}" class="card-link">Shared</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h2 class="mt-5">Shared Documents</h2>
    <div class="row sharedDocuments mb-3">
        @foreach($sharedDocuments as $document)
            <div class="col-xl-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $document->document->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $document->document->created_at }}</h6>
                        @if ($document->view === 1)
                            <a href="/ver/document/{{ $document->document->id }}" class="card-link" target="_blank">Ver</a>
                        @endif
                        @if ($document->edit === 1)
                            <a href="/documents/{{ $document->document->id }}/edit" class="card-link">Edit</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        function appendTable(params) {
            $('.documents').empty();
            $('.sharedDocuments').empty();

            for (const document of params.documents) {
                $('.documents').prepend(
                    `
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${document.title}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">${document.created_at}</h6>
                                <a href="/ver/document/${document.id}" class="card-link" target="_blank">Ver</a>
                                <a href="/documents/${document.id}/edit" class="card-link">Edit</a>
                                <a href="/shared/document/${document.id}" class="card-link">Shared</a>
                            </div>
                        </div>
                    </div>
                    `
                );
            }

            for (const document of params.sharedDocuments) {
                $('.sharedDocuments').prepend(
                    `
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${document.title}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">${document.created_at}</h6>
                                <a href="/ver/document/${document.documentId}" class="card-link" target="_blank">Ver</a>
                                <a href="/documents/${document.documentId}/edit" class="card-link">Edit</a>
                                <a href="/shared/document/${document.documentId}" class="card-link">Shared</a>
                            </div>
                        </div>
                    </div>
                    `
                );
            }
        }

        function setDefaultContent(element) {
            return $(element).val() ? $(element).val() : '-';
        }

        $( "#btnFilter" ).click(function () {
            $('#btnFilterCancel').removeClass('d-none');

            var author = setDefaultContent('#authorFilter');
            var tag = setDefaultContent('#tagsFilter');
            var createdDate = setDefaultContent('#createdAtFilter');
            var modifiedDate = setDefaultContent('#updatedAtFilter')

            $.ajax({
                type: "GET",
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : `/filter/${author}/${tag}/${createdDate}/${modifiedDate}`,
                success : function (data) {
                    appendTable(data)
                }
            }); 
        });
        
    </script>
@endsection