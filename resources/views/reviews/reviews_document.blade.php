<div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Watch Revisions
          </button>
        </h5>
      </div>
  
      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div id="reviews" class="container row mt-5">
                @foreach($allDocument[1] as $document)
                    <div class="col-sm-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Version - {{ $document->id }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $document->created_at }}</h6>
                                <a href="/ver/review/{{$document->id}}" class="card-link" target="_blank">Ver</a>
                                <a href="#" class="card-link view-document">Restaurar</a>
                                <input type="hidden" value="{{ $document-> id }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
      </div>
    </div>
</div>




