<div class="form-group">
    {!! Form::label('title', 'Title'); !!}
    {!! Form::text('title', null, ['placeholder' => 'Enter Title', 'class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::label('tags', 'Tags'); !!}
    {!! Form::text('tags', null, ['placeholder' => 'tag1, tag2', 'class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::label('body', 'Body'); !!}
    {{ $slot }}
</div>