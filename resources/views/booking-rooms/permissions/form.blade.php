<div class="form-group {{ $errors->has('name') ? 'text-danger input-danger-custom' : '' }}">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}

    @if($errors->has('name'))
        <span class="help-block text-danger">{{ $errors->first('name') }}</span>
    @endif 

</div>

<div class="form-group">
    {!! Form::label('display_name', 'Display Name') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}

    @if($errors->has('description'))
        <span class="help-block">{{ $errors->first('description') }}</span>
    @endif 
</div>

<a href="#" onclick="history.back()" type="button" class="btn btn-primary d-inline">Back</a>
{!! Form::button('Save', ['type' => 'submit','class' => 'btn btn-success']) !!}


