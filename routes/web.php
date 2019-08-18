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

Route::get('/', "PublicController@index")->name('index');
Route::get('post/{posts}', "PublicController@singlePost")->name('singlePost');
Route::get('about', "PublicController@about")->name('about');
Route::get('contact', "PublicController@contact")->name('contact');
Route::post('contact_us', "PublicController@contactUs")->name('contactUs');
Route::get('message_sent', "PublicController@messageSent")->name('messageSent');
Route::get('error', "PublicController@errorPage")->name('errorPage');
Route::get('gallery', "PublicController@gallery")->name('gallery');
Route::get('terms_and_conditions', "PublicController@termsAndConditions")->name('termsAndConditions');

Auth::routes();
Route::get('dashboard', 'HomeController@index')->name('dashboard');


//group all User page urls with the prefix "user/"
Route::prefix('user')->group(function(){

    Route::get('dashboard', "UserController@dashboard")->name('userDashboard');
    Route::get('comments', "UserController@comments")->name('userComments');
    Route::get('profile', "UserController@profile")->name('userProfile');
    Route::post('profile', "UserController@profilePost")->name('userProfilePost');
    Route::post('comments/{id}/delete', "UserController@deleteComment")->name('deleteComment');
    Route::post('new_comment', "UserController@newComment")->name('userNewComment');
});

//group all Author page urls with the prefix "author/"
Route::prefix('author')->group(function(){
    
    Route::get('dashboard', "AuthorController@dashboard")->name('authorDashboard');
    Route::get('post', "AuthorController@post")->name('authorPost');
    Route::get('comments', "AuthorController@comments")->name('authorComments');
    Route::get('post/new_post', "AuthorController@newPost")->name('authorNewPost');
    Route::get('post/{id}/edit', "AuthorController@editPost")->name('editPost');
    Route::post('post/{id}/edit', "AuthorController@postEditPost")->name('postEditPost');
    Route::post('post/{id}/delete', "AuthorController@deletePost")->name('deletePost');
    Route::post('post/new_post', "AuthorController@createNewPost")->name('createNewPost');
});

//group all Admin page urls with the prefix "admin/"
Route::prefix('admin')->group(function(){
    
    Route::get('dashboard', "AdminController@dashboard")->name('adminDashboard');
    
    Route::get('comments', "AdminController@comments")->name('adminComments');
    
    Route::get('users', "AdminController@users")->name('adminUsers');
    Route::get('users/{id}/edit', "AdminController@editUser")->name('adminEditUser');
    Route::post('user/{id}/edit', "AdminController@postEditUser")->name('adminPostEditUser');
    Route::post('users/{id}/delete', "AdminController@deleteUser")->name('adminDeleteUser');
    
    Route::get('post', "AdminController@post")->name('adminPost');
    Route::get('post/{id}/edit', "AdminController@editPost")->name('adminEditPost');
    Route::post('post/{id}/edit', "AdminController@postEditPost")->name('adminPostEdit');
    Route::post('post/{id}/delete_post', "AdminController@deletePost")->name('adminDeletePost');
    Route::post('post/{id}/delete_comment', "AdminController@deleteComment")->name('adminDeleteComment');
    
    Route::get('products', "AdminController@products")->name('adminProducts');
    Route::get('product/{id}', "AdminController@editProduct")->name('adminEditProduct');
    Route::get('products/new_product', "AdminController@newProduct")->name('adminNewProduct');
    Route::post('products/new_product', "AdminController@newProductPost")->name('adminNewProductPost');
    Route::post('product/{id}', "AdminController@editProductPost")->name('adminEditProductPost');
    Route::post('product/{id}/delete', "AdminController@deleteProduct")->name('adminDeleteProduct');
    
    Route::get('gallery', "AdminController@editGalleryView")->name('adminEditGallery');
    Route::post('gallery/add_image', "AdminController@addGalleryImage")->name('adminAddGalleryImg');
    Route::post('gallery/{id}/delete', "AdminController@deleteImg")->name('adminDeleteImg');
    Route::post('gallery/change_gallery_order/{id}', "AdminController@changeGallerySortOrder")->name('adminGallerySortOrder');
});


//group for the ecommerce shop
Route::prefix('shop')->group(function (){
    Route::get('/', "ShopController@index")->name('shopIndex');
    Route::get('product/{id}', "ShopController@singleProduct")->name('shopSingleProduct');//displays all the info about a particular product
    Route::get('product/{id}/order', "ShopController@orderProduct")->name('shopOrderProduct');//used for building order processing
    Route::get('product/{id}/execute', "ShopController@executeOrder")->name('shopExecuteOrder');//used for processing a PayPal order
});