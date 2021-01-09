@extends('layouts.main')

@section('content')
    <div class="container'fluid">
        <div class="row m-0 justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">Edit Event</div>

                    <div class="card-body">
                    {!! Form::model($events, [
                            'method'    => 'PUT',
                            'route'     => ['events.update', $events->id],  

                    ]) !!}

                        @include('booking-rooms.events.form')

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $('.datetimepicker').click(function(){
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            inline: true,
            sideBySide: true,
        });
    });
</script>
@endsection