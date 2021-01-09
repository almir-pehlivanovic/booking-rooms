# booking-rooms

## Project Description
In this project, a web application of booking rooms has been developed. Application will be used at a college or any other institution. Rooms can be free and with an hourly rate. User with enough credits can book the room with payment, also user can search all rooms and book the one that is available. The administrator has all the rights to the entire application, a student or user can add credits to their account using Stripe biling service. All users on the calendar can see if the rooms are free or not. The application access is protected on both sides (frontend and backend) and aplication is responsive for all devices.

Functionalities:

Sign-in and Sign-out
* The system use a calendar
* The administrator can create users, rooms, events and book a room for free (admin role)
* The administrator can create as many roles as he wants, each role can have different access rights to pages and actions
* Each role is assigned to a user
* The administrator will bee notifyed for all completed transactions of the users
* Users can book rooms and search all available rooms, as well as add credits from the credit card
* Credits are added via Laravel Cashier that provides an expressive, fluent interface to Stripe's subscription billing services
* Users can edit their profiles

Users who have low balance credit can be notified through a notification
Application is created using Laravel and Bootstrap, the application is simple in appearance. The goal of the application is to show the functionality of access rights, log in and logout, notifications, CRUD functionalities and implementation with payment processing software (Stripe.com)
