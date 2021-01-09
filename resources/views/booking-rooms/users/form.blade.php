<div class="form-group {{ $errors->has('name') ? 'text-danger input-danger-custom' : '' }}">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}

    @if($errors->has('name'))
        <span class="help-block text-danger">{{ $errors->first('name') }}</span>
    @endif 

</div>

<div class="form-group {{ $errors->has('email') ? 'text-danger input-danger-custom' : '' }}">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
    
    @if($errors->has('email'))
        <span class="help-block">{{ $errors->first('email') }}</span>
    @endif

</div>

<div class="form-group {{ $errors->has('password') ? 'text-danger input-danger-custom' : '' }}">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
    
    @if($errors->has('password'))
        <span class="help-block">{{ $errors->first('password') }}</span>
    @endif

</div>

<div class="form-group {{ $errors->has('password_confirmation') ? 'text-danger input-danger-custom' : '' }}">
    {!! Form::label('password_confirmation', 'Password Confirmation') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    
    @if($errors->has('password_confirmation'))
        <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
    @endif

</div>

<div class="form-group {{ $errors->has('add_role') ? 'text-danger input-danger-custom' : '' }}">   
    {!! Form::label('add_role', 'Role') !!}  
    
    @if(isset($hideRoleDropdown))   
    
        {!! Form::hidden('role', $users->roles->first()->display_name) !!}
            <p class="form-control-static">{{ $users->roles->first()->display_name }}</p>
        @else
            {!! Form::select('add_role' , App\Role::pluck('name', 'id'), null, ['class' => 'form-control text-black role', 'placeholder' => 'Select Role']) !!}
    @endif

    @if($errors->has('add_role'))
        <span class="help-block">{{ $errors->first('add_role') }}</span>
    @endif

</div>

<div class="form-group">   
    {!! Form::label('credits', 'Credits') !!}    
    @if(isset($hideRoleDropdown))   
        {!! Form::hidden('credits', $users->credits) !!}
        <p class="form-control-static">{{ ($users->credits)/100 }} $</p>
    @else
        {!! Form::number('credits', null, ['class' => 'form-control text-black role col-4', 'placeholder' => 'Example: 1000 for 10$']) !!}
    @endif
</div>

<div class="form-group">
    <img class="image-fluid" src="{{ $users->imageUrl }}" id="output" style="width: 200px; height: 200px; object-fit:cover;" alt="">
</div>

<div class="form-group">   
    {!! Form::label('image', 'Image') !!}    
    {!! Form::file('image', ['class' => 'form-control col-12 col-sm-6 col-xl-3 p-1 image-preview']) !!}
</div>



<a href="#" onclick="history.back()" type="button" class="btn btn-primary d-inline">Back</a>
{!! Form::button('Save', ['type' => 'submit','class' => 'btn btn-success']) !!}

@section('script')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('#output').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $(".image-preview").change(function() {
        readURL(this);
    });
</script>

@endsection
