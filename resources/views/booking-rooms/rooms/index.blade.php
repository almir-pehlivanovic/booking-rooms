@extends('layouts.main')

@section('content')
<div class="container'fluid">
    <div class="row m-0 justify-content-center">
        <div class="col-md-12">
            <a href=" {{ route('rooms.create') }}" type="button" class="btn btn-success">Add Room</a>
            <div class="row m-0">
                <div class="col-12 p-0 mt-3">
                    @include('booking-rooms.messages')
                </div>
            </div>
            <div class="card mt-3 mb-4">
                <div class="card-header">Rooms List</div>

                <div class="card-body">
                    <div class="float-right text-primary mb-2">

                        <?php $links = [];?>
                        @foreach($statusList as $key => $value)
                            @if($value)
                                <?php $selected = Request::get('status') == $key ? 'font-weight-bold' : '' ?>
                                <?php $links[] = "<a class=\"{$selected}\" href=\"?status={$key}\">" . ucwords($key) . " ({$value})</a>" ?>

                            @endif
                        @endforeach

                       {!! implode(' | ', $links) !!}

                    </div>
                    <div class="table-responsive">
                        
                        @if($onlyTrashed)

                            @include('booking-rooms.rooms.table-trash')
                        
                        @else
                            
                            @include('booking-rooms.rooms.table')
                        
                        @endif

                        <div class="row m-0">
                            <div class="col-6 pl-0">
                                <?php $count = $rooms->count()?>
                                <small> Showing {{ $count }} {{ Str::of('item')->plural($count)}}</small>
                            </div>
                            <div class="col-6 pr-0">
                                <div class="paginate-links float-right">
                                    {{ $rooms->appends( Request::query())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
