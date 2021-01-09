@extends('layouts.main')

@section('content')
    <div class="container'fluid">
        <div class="row m-0 justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">Edit Role</div>

                    <div class="card-body">
                    {!! Form::model($roles, [
                            'method'    => 'PUT',
                            'route'     => ['roles.update', $roles->id],  

                    ]) !!}

                        @include('booking-rooms.roles.form')

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

        $(document).ready(function() {
            var clickNumber = 0;
            $("#checkedAll").click(function() {
                    
                clickNumber++;
                    if(clickNumber == 1){
                        $(".checkSingle").each(function() {
                            this.checked=true;
                        });
                    }
                    if (clickNumber == 2){
                        $(".checkSingle").each(function() {
                            this.checked=false;
                        });
                        clickNumber = 0;
                    }
                
            });

            $(".checkSingle").click(function () {
                if ($(this).is(":checked")) {
                    var isAllChecked = 0;

                    $(".checkSingle").each(function() {
                        if (!this.checked)
                            isAllChecked = 1;
                    });

                    if (isAllChecked == 0) {
                        $("#checkedAll").prop("checked", true);
                    }     
                }
                else {
                    $("#checkedAll").prop("checked", false);
                }
            });
        });
    </script>
@endsection
