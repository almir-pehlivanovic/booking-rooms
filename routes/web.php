<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/login');

Auth::routes(['register' => false]);

Route::get('/backend/home', 'Backend\HomeController@index')->name('home');
Route::get('/backend/edit-account', 'Backend\HomeController@edit');
Route::put('/backend/edit-account', 'Backend\HomeController@update');

Route::get('/backend/bookings', 'Backend\BookingsController@searchRoom')->name('bookings.search-room');
Route::post('/backend/bookings', 'Backend\BookingsController@bookRoom')->name('bookings.book-room');

Route::get('/backend/my-credits', 'Backend\BalanceController@index')->name('balance.index');
Route::post('/backend/add-balance', 'Backend\BalanceController@add')->name('balance.add');
Route::get('/backend/show/{show}', 'Backend\BalanceController@show')->name('balance.show');

Route::get('/backend/transactions', 'Backend\TransactionsController@index')->name('transactions.index');
Route::get('/backend/transactions/{transaction}', 'Backend\TransactionsController@show')->name('transactions.show');
Route::delete('/backend/transactions/{transaction}', 'Backend\TransactionsController@destroy')->name('transactions.destroy');

Route::post('/backend/users/reminder/{user}', 'Backend\UsersController@reminder')->name('users.reminder');

Route::put('/backend/rooms/restore/{room}',[
    'uses'  => 'Backend\RoomsController@restore',
    'as'    => 'rooms.restore'
]);

Route::delete('/backend/rooms/force-destroy/{room}',[
    'uses'  => 'Backend\RoomsController@forceDestroy',
    'as'    => 'rooms.force-destroy'
]);

Route::put('/backend/events/restore/{event}',[
    'uses'  => 'Backend\EventsController@restore',
    'as'    => 'events.restore'
]);

Route::delete('/backend/events/force-destroy/{event}',[
    'uses'  => 'Backend\EventsController@forceDestroy',
    'as'    => 'events.force-destroy'
]);

Route::put('/backend/users/restore/{user}',[
    'uses'  => 'Backend\UsersController@restore',
    'as'    => 'users.restore'
]);

Route::delete('/backend/users/force-destroy/{user}',[
    'uses'  => 'Backend\UsersController@forceDestroy',
    'as'    => 'users.force-destroy'
]);


Route::resources([
    'backend/rooms'       => 'Backend\RoomsController',
    'backend/events'      => 'Backend\EventsController',
    'backend/users'       => 'Backend\UsersController',
    'backend/calendar'    => 'Backend\CalendarController',
    'backend/permissions' => 'Backend\PermissionsController',
    'backend/roles'       => 'Backend\RolesController',
]);
