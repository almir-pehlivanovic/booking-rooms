@if(session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(session('trash-message'))
    <?php list($message, $roomId) =session('trash-message') ?>
        {!! Form::open(['method' => 'PUT', 'route' => ['rooms.restore', $roomId]]) !!}
            <div class="alert alert-info align-items-center d-flex justify-content-between">
                {{ $message }}
                <div class="d-flex d-flex justify-content-between">
                    <button type="submit" class="btn btn-sm btn-warning"> <i class="fa fa-undo"></i> Undo </button>
                    <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        {!! Form::close() !!}

@elseif(session('event-trash-message'))
    <?php list($message, $eventId) =session('event-trash-message') ?>
        {!! Form::open(['method' => 'PUT', 'route' => ['events.restore', $eventId]]) !!}
            <div class="alert alert-info align-items-center d-flex justify-content-between">
                {{ $message }}
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-sm btn-warning"> <i class="fa fa-undo"></i> Undo </button>
                    <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
            </div>
        {!! Form::close() !!}
@elseif(session('user-trash-message'))
    <?php list($message, $userId) =session('user-trash-message') ?>
        {!! Form::open(['method' => 'PUT', 'route' => ['users.restore', $userId]]) !!}
            <div class="alert alert-info align-items-center d-flex justify-content-between">
                {{ $message }}
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-sm btn-warning"> <i class="fa fa-undo"></i> Undo </button>
                    <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
            </div>
        {!! Form::close() !!}
@elseif(session('message-transaction'))
    <div class="alert alert-success">
        {{ session('message-transaction') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(session('message-alert'))
    <div class="alert alert-danger">
        {{ session('message-alert') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif