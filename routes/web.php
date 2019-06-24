<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Tickets
Route::get('/tickets', 'TicketController@index')->name('ticket.index');
Route::get('/ticket/create', 'TicketController@create')->name('ticket.create');
Route::post('/ticket', 'TicketController@store')->name('ticket.store');
Route::get('/ticket/{ticket_id}', 'TicketController@show')->name('ticket.show');
Route::get('/user/{user}/tickets', 'TicketController@userTickets')->name('ticket.userTickets');
Route::get('/ticket/{ticket}/edit', 'TicketController@edit')->name('ticket.edit');
Route::patch('/ticket/{ticket}', 'TicketController@update')->name('ticket.update');
Route::delete('/ticket/{ticket}', 'TicketController@update')->name('ticket.destroy');


// Comments
Route::post('/comment', 'CommentController@store')->name('comment.create');