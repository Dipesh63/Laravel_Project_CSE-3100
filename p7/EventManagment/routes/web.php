<?php


use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/account/registration',[HomeController::class,'register'])->name('account.registration');
Route::post('/account/registring',[HomeController::class,'processRegistration'])->name('account.processRegistration');
Route::get('/account/login',[HomeController::class,'login'])->name('account.login');

Route::post('/account/authenticate_User',[HomeController::class,'authenticateUser'])->name('account.authenticateUser');

Route::get('/account/profilePage',[HomeController::class,'loadProfilePage'])->name('account.profile');
Route::get('/account/logout',[HomeController::class,'logoutfunc'])->name('account.logout');




Route::get('/account/profilePage',[HomeController::class,'loadProfilePage'])->name('account.profile');

Route::post('/account/profilePage', [HomeController::class, 'UpdateProfile'])->name('account.profilePage');

Route::put('/account/UpdateProfile',[HomeController::class,'UpdateProfile'])->name('account.UpdateProfile');



Route::post('/account/UpdateProfilePic',[HomeController::class,'UpdateProfilePic'])->name('account.updateProfilePic');



Route::get('/account/create_event',[HomeController::class,'create_event'])->name('account.create_event');










//Events------------------------------------------------->>>>>
Route::get('/event/create', [HomeController::class, 'create_event'])->name('event.create');
Route::post('/event/store', [HomeController::class, 'store'])->name('event.store');

Route::get('/event/myevents', [HomeController::class, 'myevents'])->name('event.myevents');


Route::delete('/events/{id}', [HomeController::class, 'deleteJob'])->name('event.delete');






//Event showing 

Route::get('/eventindex', [HomeController::class, 'Eventindex'])->name('event.index');
//Route::post('/event/eventDetail/{event_id}', [HomeController::class, 'show_eventDetail'])->name('event.eventDetail');
Route::get('/event/eventDetail/{event_id}', [HomeController::class, 'show_eventDetail'])->name('event.eventDetail');


Route::post('/event/applyjob', [HomeController::class, 'applyjob'])->name('applyJob');

















//Admin**********************************************
Route::get('/admin/dashboard', [HomeController::class, 'dashboardindex'])->name('dashboardindex');


Route::get('/admin/showingallusers', [HomeController::class, 'showingallusers'])->name('showingallusers');
Route::get('/admin/showingallusers2', [HomeController::class, 'showingallusers2'])->name('showingallusers2');
Route::delete('/users/{id}', [HomeController::class, 'destroy'])->name('users.destroy');
Route::delete('/users', [HomeController::class, 'destroy2'])->name('users.destroy2');




Route::get('/admin/showingalljobs', [HomeController::class, 'showingalljobs'])->name('showingalljobs');
Route::delete('/admin/deletingevents', [HomeController::class, 'destroyevent'])->name('destroyevent');













Route::get('/admin/editEvent/{id}', [HomeController::class, 'admineditjob'])->name('admin.events.edit');

Route::put('/admin/updateEvent/{id}', [HomeController::class, 'updatejobByadmin'])->name('admin.events.update');











//my favourites***********************************************************************************************************
//********************************************************************************************************************** */
Route::get('/comment',[HomeController::class,'commentfunc'])->name('event.comment');


Route::post('/comment',[HomeController::class,'savecomment'])->name('event.storecomment');




