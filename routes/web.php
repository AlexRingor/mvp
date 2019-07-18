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
    return redirect('/mvph');
});

Route::get('/mvph', 'Controller@mvph');


Route::get('/landingpage', 'Controller@landingPage');
Route::get('/news', 'Controller@news');
Route::get('/content_creators', 'Controller@contentCreatorSolo');

Route::get('/content-creator/{id}', 'Controller@content_creator');
Route::get('/video/{id}', 'Controller@video');
Route::get('/profile/{id}', 'Controller@profile');

Route::post('/user/post/{id}', 'Controller@userPost');
Route::get('/user/deleteArticle/{id}', 'Controller@deleteArticle');
Route::get('/user/viewprofile/{id}', 'Controller@viewProfile');
Route::post('/user/editArticle/{id}', 'Controller@editArticle');
Route::post('/user/editPost/{id}', 'Controller@editPost');
Route::post('/user/reply', 'Controller@reply');
Route::post('/user/addCommentToPost', 'Controller@addCommentToPost');
Route::get('/user/deletecomment/{id}', 'Controller@deleteComment');
Route::get('/user/deletecommentfromfeed/{id}', 'Controller@deleteCommentFromFeed');
Route::post('/user/editcomment/{id}', 'Controller@editComment');
Route::post('/user/editPostComment/{id}', 'Controller@editPostComment');


Route::post('/delete/post/{id}', 'Controller@deletePost');
Route::post('/submitArticle/{id}', 'Controller@submitArticle');

Route::get('/admin/manage', 'Controller@manageUsers');
Route::get('/admin/makeViewerContentCreator/{id}', 'Controller@makeViewerContentCreator');
Route::get('/admin/demoteToViewer/{id}', 'Controller@demoteToViewer');
Route::get('/admin/makeAdmin/{id}', 'Controller@makeAdmin');
Route::get('/admin/deleteUser/{id}', 'Controller@deleteUser');
Route::get('/admin/manageArticle', 'Controller@manageArticle');
Route::get('/admin/approvePost/{id}', 'Controller@approvePost');
Route::get('/admin/rejectPost/{id}', 'Controller@rejectPost');
Route::get('/admin/pendingPost/{id}', 'Controller@pendingPost');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
