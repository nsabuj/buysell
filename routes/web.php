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
use Illuminate\Support\Facades\Auth;


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/myaccount','HomeController@myaccount');
Route::get('/single-ad/{id}','HomeController@show_single_ad');
Route::get('/contact', 'ContactController@show');
Route::post('/contact',  'ContactController@mailToAdmin'); 

// ajax req
//ad ajax
Route::post('/delete_ad_image','AdvertisementsController@delete_ad_image');

//end ajax

//Route::post('/sendMessage', function (){
//    return 'test';
//});


// chat
Route::post('/sendMessage', array('uses' => 'ChatController@sendMessage'));
Route::post('/isTyping', array('uses' => 'ChatController@isTyping'));
Route::post('/notTyping', array('uses' => 'ChatController@notTyping'));
Route::post('/retrieveChatMessages', array('uses' => 'ChatController@retrieveChatMessages'));
Route::post('/retrieveTypingStatus', array('uses' => 'ChatController@retrieveTypingStatus'));
//end chat

//end ajax
Auth::routes();

 Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function()
 {
    CRUD::resource('role', 'RoleCrudController');
    CRUD::resource('user', 'UserCrudController');
    CRUD::resource('media', 'MediaCrudController');
    CRUD::resource('category', 'CategoryCrudController');
    CRUD::resource('adminoption', 'AdminoptionCrudController');

});


 Route::group(['prefix' => 'admin', 'middleware' => ['admin'],], function()
 {
   
    Route::get('/create_ad','AdvertisementsController@admin_create');
    Route::post('/create_ad','AdvertisementsController@admin_store');
    Route::get('/all_ads','AdvertisementsController@admin_allAds');
    Route::get('/edit_ad/{id}','AdvertisementsController@admin_edit');
    Route::post('/update_ad','AdvertisementsController@admin_update');
    Route::get('/delete_ad/{id}','AdvertisementsController@admin_destroy');
    Route::get('/delete_ad/{id}','AdvertisementsController@admin_destroy');
});

//Route::get('/', 'HomeController@index')->name('home');


/* seller dashboard */

Route::group(['prefix'=>'seller','middleware' => ['auth','seller'],'namespace' => 'Seller'], function()
{
    Route::get('/myaccount','SellerController@index');
    Route::get('/','SellerController@index');


});
// ads
Route::group(['prefix'=>'seller','middleware' => ['auth','seller'],], function()
{

    Route::get('/create_ad','AdvertisementsController@create');
    Route::post('/create_ad','AdvertisementsController@store');
    Route::get('/my_ads','AdvertisementsController@allAds');
    Route::get('/edit_ad/{id}','AdvertisementsController@edit');
    Route::post('/update_ad','AdvertisementsController@update');
    Route::get('/delete_ad/{id}','AdvertisementsController@destroy');
    Route::get('/delete_ad/{id}','AdvertisementsController@destroy');
    Route::get('/card/{id}','PaypalPaymentController@create_card');
    Route::post('/card','PaypalPaymentController@store_card');
    Route::get('/paypal/{id}','PaypalPaymentController@create_paypal');
    Route::post('/paypal','PaypalPaymentController@paypal_payment');
    Route::get('/payment/status', array(
        'as' => 'payment.status',
        'uses' => 'PaypalPaymentController@satus_paypal',
    ));
    Route::get('/my_ads', array(
        'as' => 'original.route',
        'uses' => 'AdvertisementsController@allAds',
    ));

});

/*buyer routes */
Route::group(['prefix'=>'user','middleware' => ['auth','buyer'],], function()
{
    Route::get('/myaccount','BuyerController@index');
});

/*buyer routes */
Route::group(['prefix'=>'user','middleware' => ['auth'],], function()
{
    Route::get('/edit','BuyerController@edit');
    Route::post('/edit','BuyerController@update_user');
    Route::get('/messages','BuyerController@chats');
    Route::get('/chat/{id}','BuyerController@chat');
    Route::get('/chat/{id}/{ref}/{ad_id}','BuyerController@create_chat');
});

Route::resource('payment', 'PaypalPaymentController');
