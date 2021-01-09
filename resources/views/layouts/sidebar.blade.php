<nav id="sidebar">
    <div class="sidebar-header">
        <img class = "img-fluid" src="{{ asset('images/LogoDesign2.png') }}" alt="">
        <h3 class="d-inline">Control Panel</h3>
    </div>

    <ul class="list-unstyled components">
        <small class="welcome-text">WELCOME</small>
        <p class="pt-0">{{ auth()->user()->name }}</p>
        <li>
            <a href="{{ route('home') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </li>
        @role('user')
        <li>
            <a href="{{ route('balance.index') }}"><i class="fas fa-dollar-sign"></i> My Credits</a>
        </li>
        @endrole
        @role('admin')
        <li>
            <a href="{{ route('transactions.index') }}"><i class="fas fa-dollar-sign"></i> Transactions</a>
        </li>
       
        <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class ="dropdown-toggle"><i class="fas fa-users"></i> User Managment </a>
            <ul class="collapse list-unstyled" id = "homeSubmenu">
                <li>
                    <a href="{{ route('permissions.index') }}"><i class="far fa-circle"></i> Permissions</a>
                </li>
                <li>
                    <a href="{{ route('roles.index') }}"><i class="far fa-circle"></i> Roles</a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}"><i class="far fa-circle"></i> Users</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="{{ route('rooms.index') }}"><i class="fas fa-cogs"></i> Rooms</a>
        </li>
        <!-- <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-th"></i> Page</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#"><i class="far fa-circle"></i> page1</a>
                </li>
                <li>
                    <a href="#"><i class="far fa-circle"></i> page2</a>
                </li>
                <li>
                    <a href="#"><i class="far fa-circle"></i> page3</a>
                </li>
            </ul>
        </li> -->
        <li>
            <a href="{{ route('events.index') }}"> <i class="fas fa-cogs"></i> Events</a>
        </li>
        @endrole
        <li>
            <a href="{{ route('calendar.index') }}"> <i class="far fa-calendar-alt"></i> Calendar</a>
        </li>
        <li>
            <a href="{{ route('bookings.search-room') }}"> <i class="far fa-calendar-alt"></i> Search Room</a>
        </li>
    </ul>

    <ul class="list-unstyled CTAs">
        <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" 
                class="download" ><i class="fas fa-sign-out-alt"></i> Sign out</a>
        </li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</nav>