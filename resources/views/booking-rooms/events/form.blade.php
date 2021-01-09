
<div class="form-group {{ $errors->has('room_id') ? 'text-danger input-danger-custom' : '' }}">
    {!! Form::label('room_id', 'Room') !!}
    {!! Form::select('room_id', App\Room::pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select room' ]) !!}

    @if($errors->has('room_id'))
        <span class="help-block text-danger">{{ $errors->first('room_id') }}</span>
    @endif 

</div>

<div class="form-group {{ $errors->has('user_id') ? 'text-danger input-danger-custom' : '' }}">
    {!! Form::label('user_id', 'User') !!}
    {!! Form::select('user_id', App\User::pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select user' ]) !!}

    @if($errors->has('user_id'))
        <span class="help-block text-danger">{{ $errors->first('user_id') }}</span>
    @endif 

</div>

<div class="form-group {{ $errors->has('name') ? 'text-danger input-danger-custom' : '' }}">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}

    @if($errors->has('name'))
        <span class="help-block text-danger">{{ $errors->first('name') }}</span>
    @endif 

</div>

<div class="form-group {{ $errors->has('start_time') ? 'text-danger input-danger-custom' : '' }}">
    {!! Form::label('start_time', 'Start Time') !!}
    {!! Form::datetimeLocal('start_time', (isset($events)) ? $events->start_time : null, ['class' => 'col-3 form-control']) !!}
    
    @if($errors->has('start_time'))
        <span class="help-block">{{ $errors->first('start_time') }}</span>
    @endif

</div>

<div class="form-group {{ $errors->has('end_time') ? 'text-danger input-danger-custom' : '' }}">
    {!! Form::label('end_time', 'End Time') !!}
    {!! Form::datetimeLocal('end_time',  (isset($events)) ? $events->end_time : null, ['class' => 'col-3 form-control']) !!}
    
    @if($errors->has('end_time'))
        <span class="help-block">{{ $errors->first('end_time') }}</span>
    @endif

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

