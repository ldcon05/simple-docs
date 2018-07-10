<h2 class="mt-5 mb-3">Busqueda</h2>
<div class="row">
    <div class="col-md-3">{!! Form::text('authorFilter', null, ['placeholder' => 'Enter author email', 'class' => 'form-control', 'id' => 'authorFilter'])!!}</div>
    <div class="col-md-3">{!! Form::text('tagsFilter', null, ['placeholder' => 'Enter tag', 'class' => 'form-control', 'id' => 'tagsFilter'])!!}</div>
    <div class="col-md-3">{!! Form::text('createdAtFilter', null, ['placeholder' => '2018-07-09', 'class' => 'form-control', 'id' => 'createdAtFilter'])!!}</div>
    <div class="col-md-3">{!! Form::text('updatedAtFilter', null, ['placeholder' => '2018-07-09', 'class' => 'form-control', 'id' => 'updatedAtFilter'])!!}</div>
</div>

<div class="d-flex justify-content-center mb-5 mt-3">
    <button type="button" id="btnFilter" class="btn btn-outline-primary mr-3">Find</button>
    <a href="/documents" id="btnFilterCancel" class="btn btn-outline-secondary d-none">Cancel Filter</a>
</div>