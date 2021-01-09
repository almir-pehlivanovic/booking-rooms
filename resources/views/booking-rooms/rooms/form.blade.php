<div class="form-group {{ $errors->has('name') ? 'text-danger input-danger-custom' : '' }}">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}

    @if($errors->has('name'))
        <span class="help-block text-danger">{{ $errors->first('name') }}</span>
    @endif 

</div>

<div class="form-group">
    {!! Form::label('capacity', 'Capacity') !!}
    {!! Form::number('capacity', null, ['class' => 'form-control']) !!}
    
    @if($errors->has('capacity'))
        <span class="help-block">{{ $errors->first('capacity') }}</span>
    @endif

</div>

<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}

    @if($errors->has('description'))
        <span class="help-block">{{ $errors->first('description') }}</span>
    @endif 
</div>

<div class="form-group  pl-0 col-3">
    {!! Form::label('hourly_rate', 'Hourly Rate') !!}
    {!! Form::number('hourly_rate', null, ['class' => 'form-control']) !!}
</div>

<a href="#" onclick="history.back()" type="button" class="btn btn-primary d-inline">Back</a>
{!! Form::button('Save', ['type' => 'submit','class' => 'btn btn-success']) !!}


