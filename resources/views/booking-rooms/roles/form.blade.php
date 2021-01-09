
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

<div class="form-group  {{ $errors->has('permission') ? 'text-danger input-danger-custom' : '' }}">
    {!! Form::label('permissions', 'Permissions') !!}
    <br>
    <button name="checkedAll"  id = "checkedAll" type="button" class="btn btn-info btn-sm">Select All</button>
    <ul class="h-auto list-inline bg-light text-dark form-control permission-list-width" name="permissions">
        @foreach($permissions as $permission)
        <?php   $permissionId   = $permission->id; 
                $permissionName = $permission->name; ?>
            <li class="list-inline-item roles-mobile">
                <div class="form-check form-check-inline">
                    {!! Form::checkbox('permission[]', $permissionId, $permissionCheck, ['class' => 'form-check-input checkSingle']) !!}
                    {!! Form::label('permission', $permissionName, ['class' => 'form-check-label ml-2']) !!}
                </div>
            </li>
        @endforeach
    </ul>

    @if($errors->has('permission'))
        <span class="help-block text-danger">{{ $errors->first('permission') }}</span>
    @endif 
</div>

<br>
<a href="#" onclick="history.back()" type="button" class="btn btn-primary d-inline">Back</a>
{!! Form::button('Save', ['type' => 'submit','class' => 'btn btn-success']) !!}


