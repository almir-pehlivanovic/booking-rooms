@extends('layouts.main')

@section('content')
<div class="container'fluid">
    <div class="row m-0 justify-content-center">
        <div class="col-md-12">
            <a href=" {{ route('permissions.create') }}" type="button" class="btn btn-success">Add Permission</a>
            <div class="row m-0">
                <div class="col-12 p-0 mt-3">
                    @include('booking-rooms.messages')
                </div>
            </div>
            <div class="card mt-3 mb-4">
                <div class="card-header">Permissions List</div>

                <div class="card-body">
                    <div class="table-responsive">
                        
                            @include('booking-rooms.permissions.table')
                        
                        <div class="row m-0">
                            <div class="col-6 pl-0">
                                <?php $count = $permissions->count()?>
                                <small> Showing {{ $count }} {{ Str::of('item')->plural($count)}}</small>
                            </div>
                            <div class="col-6 pr-0">
                                <div class="paginate-links float-right">
                                    {{ $permissions->appends( Request::query())->links() }}
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
