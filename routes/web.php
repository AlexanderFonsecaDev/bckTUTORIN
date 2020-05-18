<?php

;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group([
    'prefix'     => 'admin',
    'namespace'  => 'Admin',
    'middleware' => 'auth'
],function (){
    Route::get('/', function (){
        return redirect('/home');
    })->name('inicio');
    Route::resource('students','StudentController')->except('update');
    Route::put('students/{user:id}','StudentController@update')->name('students.update');
    Route::resource('teachers','TeacherController');

    Route::post('fileDocument','TeacherController@addFile')->name('teachers.file');
    Route::post('message','TeacherController@message')->name('teachers.message');
    Route::post('viewed','TeacherController@viewed')->name('teachers.viewed');
    Route::post('verify','TeacherController@verifyDocument')->name('teachers.verify');
    Route::get('searchTeacher/{search}', 'TeacherController@showStatuses')->name('teacher.status')->where('search', '.*');


    Route::resource('task','TaskController');
    Route::resource('advisory','AdvisoryController');
    Route::resource('course','CourseController');
    Route::resource('pqr','PQRController');

    Route::get('searchAdvisory/{search}', 'AdvisoryController@showStatuses')->name('advisory.status')->where('search', '.*');
    Route::get('searchTask/{search}', 'TaskController@showStatuses')->name('task.status')->where('search', '.*');
    Route::get('searchCourses/{search}', 'CourseController@showStatuses')->name('courses.status')->where('search', '.*');

    Route::resource('category','CategoryController');
    Route::resource('zone','ZoneController');
    Route::resource('tag','TagController');
    Route::resource('level','LevelController');


    /*Route::get()->name('tags.tasks');*/

    Route::post('admin','AdminController@store')->name('admin.store');
    Route::get('admin','AdminController@index')->name('admin.index');
    Route::get('admin/create','AdminController@create')->name('admin.create');
    Route::delete('admin/{user:id}','AdminController@destroy')->name('admin.destroy');
    Route::put('admin/{user:id}','AdminController@update')->name('admin.update');
    Route::get('admin/{user:id}','AdminController@show')->name('admin.show');
    Route::get('admin/{user:id}/edit','AdminController@edit')->name('admin.edit');


    Route::delete('comment/{comment}','AdminController@deleteComment')->name('comment.delete');
    Route::delete('offer/{offer}','AdminController@deleteOffer')->name('offer.delete');

    Route::delete('image/{image}','AdminController@deleteImage')->name('image.delete');
    Route::delete('document/{file}','AdminController@deleteDocument')->name('document.delete');

});


Route::get('/home', 'HomeController@index');

Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login');
Route::post('logout','Auth\LoginController@logout')->name('logout');

/*Route::get('register','Auth\RegisterController@showResgistrationForm')->name('register');
Route::post('register','Auth\RegisterController@register');*/

Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestFrom')->name('password.request');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset','Auth\ResetPasswordController@reset');
