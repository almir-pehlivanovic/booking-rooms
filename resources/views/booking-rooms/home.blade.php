@extends('layouts.main')

@section('content')
<div class="container'fluid">
    <div class="row m-0 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <h5 class="mt-4">{{ __('Project Description') }}</h5>
                    <p class="text-dark">
                        In this project, a web application of booking rooms has been developed. Application will be used at a college or any other institution. 
                        Rooms can be free and with an hourly rate. User with enough credits can book the room with payment, also user can search all rooms and book the one that is available. 
                        The administrator has all the rights to the entire application, a student or user can add credits to their account using Stripe biling service. 
                        All users on the calendar can see if the rooms are free or not. The application access is protected on both sides (frontend and backend) and aplication is responsive for all devices.                    
                    </p>
                    <p class="text-dark">Functionalities:</p>
                    <ul class="list-group">
                        <li class="list-group-item">
                            Sign-in and Sign-out
                        </li>
                        <li class="list-group-item">
                            The system use a calendar
                        </li>
                        <li class="list-group-item">
                            The administrator can create users, rooms, events and book a room for free (admin role)
                        </li>
                        <li class="list-group-item">
                            The administrator can create as many roles as he wants, each role can have different access rights to pages and actions
                        </li>
                        <li class="list-group-item">
                            Each role is assigned to a user
                        </li>
                        <li class="list-group-item">
                            The administrator will bee notifyed for all completed transactions of the users
                        </li>
                        <li class="list-group-item">
                            Users can book rooms and search all available rooms, as well as add credits from the credit card
                        </li>
                        <li class="list-group-item">
                            Credits are added via Laravel Cashier that provides an expressive, fluent interface to Stripe's subscription billing services
                        </li>
                        <li class="list-group-item">
                            Users can edit their profiles
                        </li>
                        <li class="list-group-item">
                            Users who have low balance credit can be notified through a notification
                        </li>
                    </ul>
                    <p class="mt-4 text-dark">
                        Application is created using Laravel and Bootstrap, the application is simple in appearance. The goal of the application is to show the functionality of access rights, log in and logout, notifications, CRUD functionalities and implementation with payment processing software (Stripe.com)</p>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
