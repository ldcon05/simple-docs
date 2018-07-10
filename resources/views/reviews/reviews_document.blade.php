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