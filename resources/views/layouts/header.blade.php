<?php   use App\User;
        use App\Room;
        $currentUser    = auth()->user();
        $notifications  = $currentUser->unreadNotifications->count();

?>
<div class="content container-fluid p-0">
    <div class="row m-0 header-collor mb-4">
        <div class="col-12 order-sm-2 col-lg-11 col-sm-9 text-center text-sm-right">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="" class="dropdown-toggle nav-link position-relative" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        @if($notifications != 0)
                            <span class="badge badge-danger badge-custom">{{ $notifications }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu notifications-menu-width">
                        @if($notifications != 0)
                            <li class="header text-left pl-2">You have {{ $notifications }} notifications</li>
                        @endif
                        <hr class="header-line">
                        <li>
                            <ul class="menu menu-notifications p-0">
                                @if($notifications != 0)
                                    @foreach($currentUser->unreadNotifications as $notification)
                                            @if($notification->notifiable_id != 1)
                                                <li class="menu-hover">
                                                    <a href="{{ route('balance.show', $notification->data['id']) }}">
                                                        <p><i class="fas fa-dollar-sign text-danger"></i> {{ $notification->data['message'] }}</p>
                                                    </a>
                                                    <span class="font-weight-normal p-1 pl-3 text-secondary"> {{ $notification->created_at->diffForHumans()}}</span>
                                                </li>
                                            @else
                                                @if(is_null($notification->data['room']))
                                                <?php $userName = User::where('id', $notification->data['user'])->first();?>
                                                    <li class="menu-hover">
                                                        <a href="{{ route('transactions.show', $notification->data['id']) }}">
                                                        @if($userName)
                                                            <p><i class="fas fa-dollar-sign text-success"></i>{{ $userName->name }} added {{ ($notification->data['amount']) / 100 }} credits to account  </p>
                                                        @endif
                                                        </a>
                                                        <span class="font-weight-normal p-1 pl-3 text-secondary"> {{ $notification->created_at->diffForHumans()}}</span>
                                                    </li>
                                                @else
                                           
                                                <?php $userName = User::where('id', $notification->data['user'])->first();?>
                                                <?php $roomName = Room::where('id', $notification->data['room'])->first();?>
                                                <li class="menu-hover">
                                                    <a href="{{ route('transactions.show', $notification->data['id']) }}">
                                                    @if($userName)
                                                        <p><i class="far fa-bookmark text-warning"></i>{{ $userName->name }} book the room {{ $roomName->name }}</p>
                                                    @endif
                                                    </a>
                                                    <span class="font-weight-normal p-1 pl-3 text-secondary"> {{ $notification->created_at->diffForHumans()}}</span>
                                                </li>
                                                @endif 
                                            @endif
                                    @endforeach
                                    <hr class="footer-line">
                                    <li class="footer text-center">
                                        <a href="#">Read all notifications</a>
                                    </li>
                                @else
                                    <li class="menu-hover text-center">
                                        <i class="far fa-bell fa-2x"></i>
                                        <p> No new notifications </p>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- <li class="list-inline-item">
                    <a href="" class="dropdown-toggle nav-link position-relative" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope"></i>
                        <span class="badge badge-warning badge-custom">4</span>
                    </a>
                    <ul class="dropdown-menu notifications-menu-width" >
                        <li class="header text-left pl-2">You have 4 messages</li>
                        <hr class="header-line">
                        <li>
                            <ul class="menu p-0">
                                <li class="menu-hover">
                                    <a href="#">
                                        <div class="float-left">
                                            <img src="{{ asset('images/user2.jpg') }}" class="img-circle" alt="User Image">
                                        </div>
                                        <h4>Support Team <small><i class="fa fa-clock"></i> 5 mins</small></h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                                <li class="menu-hover">
                                    <a href="#">
                                        <div class="float-left">
                                            <img src="{{ asset('images/user2.jpg') }}" class="img-circle" alt="User Image">
                                        </div>
                                        <h4>Support Team <small><i class="fa fa-clock"></i> 5 mins</small></h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                                <li class="menu-hover">
                                    <a href="#">
                                        <div class="float-left">
                                            <img src="{{ asset('images/user2.jpg') }}" class="img-circle" alt="User Image">
                                        </div>
                                        <h4>Support Team <small><i class="fa fa-clock"></i> 5 mins</small></h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                                <hr class="footer-line">
                                <li class="footer text-center">
                                    <a href="#">See All Messages</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->
                <li class="list-inline-item user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{$currentUser->imageUrl}}" class="user-image" alt="User Image">
                        <span class="d-none d-sm-inline">{{ $currentUser->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-user notifications-menu-width" >
                    
                        <li class="user-header">
                            <img src="{{$currentUser->imageUrl}}" class="img-circle" alt="User Image">
            
                            <p> {{ $currentUser->name }} - Web Developer
                            <small>Member since {{ $currentUser->created_at->format('M.Y' ) }}</small>
                            </p>
                        </li>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-6 text-center">
                                <a href="{{ url('/backend/edit-account') }}" type="button" class="btn btn-info pl-3 pr-3"> Profile</a>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"  type="button" class="btn btn-secondary pl-3 pr-3"> Sign out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </ul>
                </li>
                
            </ul>
        </div>
        <div class="col-1 order-sm-1 col-lg-1 col-sm-3 custom-padding-mobile">
            <nav class="navbar-expand-lg navbar-light bg-light">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fa fa-align-justify"></i>
                </button>
            </nav>
        </div>
    </div>

    @yield('content')

</div>