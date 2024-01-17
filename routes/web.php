<?php

use App\Models\Product;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TownshipController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Auth\LoginController as FacebookLoginController;

//login //register

// Route::redirect('/','signin');
Route::get('admin/signin',[AuthController::class,'login'])->name('auth#login');
Route::get('admin/signup',[AuthController::class,'register'])->name('auth#register');



//['auth:sanctum',config('jetstream.auth_session'),'verified']
Route::middleware('auth')->group(function () {

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('dashboard',[AuthController::class,'dashboard'])->name('auth#dashboard');


    Route::group(['prefix'=>'admin','middleware'=>['admin_auth:admin']],function(){
         //Admin

        //Category
        Route::get('category/list',[CategoryController::class,'categorylist'])->name('admin#categorylist');
        Route::get('category/create',[CategoryController::class,'categorycreate'])->name('admin#categorycreate');
        Route::post('category/store',[CategoryController::class,'categorystore'])->name('admin#categorystore');
        Route::get('category/delete/{id}',[CategoryController::class,'categorydelete'])->name('admin#categorydelete');
        Route::get('category/edit/{id}',[CategoryController::class,'categoryedit'])->name('admin#categoryedit');
        Route::post('category/update/{id}',[CategoryController::class,'categoryupdate'])->name('admin#categoryupdate');

        //Password
        Route::get('account/change-password',[AdminController::class,'passwordchange'])->name('admin#passwordchange');
        Route::post('account/change-password',[AdminController::class,'passwordchangestore'])->name('admin#passwordchangestore');
        Route::get('account/profile',[AdminController::class,'profile'])->name('admin#profile');
        Route::get('account/edit-profile',[AdminController::class,'editprofile'])->name('admin#editprofile');
        Route::post('account/update-profile',[AdminController::class,'updateprofile'])->name('admin#updateprofile');
        Route::get('list',[AdminController::class,'list'])->name('admin#list');
        Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
        Route::get('change/role/{id}',[AdminController::class,'changerole'])->name('admin#changerole');
        Route::post('change/role/{id}',[AdminController::class,'changerolestore'])->name('admin#changerolestore');

        //Product
        Route::get('product/list',[ProductController::class,'productlist'])->name('admin#productlist');
        Route::get('product/create',[ProductController::class,'productcreate'])->name('admin#productcreate');
        Route::post('product/store',[ProductController::class,'productstore'])->name('admin#productstore');
        Route::get('product/delete/{id}',[ProductController::class,'productdelete'])->name('admin#productdelete');
        Route::get('product/edit/{id}',[ProductController::class,'productedit'])->name('admin#productedit');
        Route::post('product/update/{id}',[ProductController::class,'productupdate'])->name('admin#productupdate');
        Route::get('product/detail/{id}',[ProductController::class,'productdetail'])->name('admin#productdetail');

        //Orders
        Route::get('order/list',[AdminOrderController::class,'index'])->name('admin#orderlist');
        Route::get('/orders/{order}/edit',[AdminOrderController::class,'edit'])->name('admin#orderedit');
        Route::put('/orders/{order}',[AdminOrderController::class,'update'])->name('admin#orderupdate');
        Route::post('/orders/bulk-action',[AdminOrderController::class,'bulkAction'])->name('admin#orderbulkAction');

        //Country
        Route::get('country/list',[CountryController::class,'index'])->name('admin#countrylist');
        Route::get('country/create',[CountryController::class,'create'])->name('admin#countrycreate');
        Route::post('country/store',[CountryController::class,'store'])->name('admin#countrystore');
        Route::get('country/edit/{id}',[CountryController::class,'edit'])->name('admin#countryedit');
        Route::post('country/update/{id}',[CountryController::class,'update'])->name('admin#countryupdate');
        Route::get('country/delete/{id}',[CountryController::class,'destroy'])->name('admin#countrydelete');

        //State
        Route::get('state/list',[StateController::class,'index'])->name('admin#statelist');
        Route::get('state/create',[StateController::class,'create'])->name('admin#statecreate');
        Route::post('state/store',[StateController::class,'store'])->name('admin#statestore');
        Route::get('state/edit/{id}',[StateController::class,'edit'])->name('admin#stateedit');
        Route::post('state/update/{id}',[StateController::class,'update'])->name('admin#stateupdate');
        Route::get('state/delete/{id}',[StateController::class,'destroy'])->name('admin#statedelete');

        //State
        Route::get('township/list',[TownshipController::class,'index'])->name('admin#townshiplist');
        Route::get('township/create',[TownshipController::class,'create'])->name('admin#townshipcreate');
        Route::post('township/store',[TownshipController::class,'store'])->name('admin#townshipstore');
        Route::get('township/edit/{id}',[TownshipController::class,'edit'])->name('admin#townshipedit');
        Route::post('township/update/{id}',[TownshipController::class,'update'])->name('admin#townshipupdate');
        Route::get('township/delete/{id}',[TownshipController::class,'destroy'])->name('admin#townshipdelete');

        //Invoice
        Route::get('/invoice/{id}',[InvoiceController::class,'generateInvoice'])->name('admin#invoice.generate');

        //Reviews
        Route::get('/reviews',[ReviewController::class,'index'])->name('admin#reviewindex');


    });

});



Route::middleware('auth')->group(function () {

    //Route::get('dashboard',[AuthController::class,'dashboard'])->name('auth#dashboard');
//User
    Route::group(['middleware'=>'customer_auth'],function(){

        //Route::get('home',[CategoryController::class,'categorylist'])->name('admin#categorylist');
        //Route::get('/my-account',[CustomerController::class,'myaccount'])->name('customer#myaccount');

    });
});

Route::group(['middleware'=>['customer_auth:customer']],function(){

    //Route::get('home',[CategoryController::class,'categorylist'])->name('admin#categorylist');
    Route::get('/my-account',[CustomerController::class,'myaccount'])->name('customer#myaccount');
    Route::post('/updateprofile',[CustomerController::class,'updateprofile'])->name('customer#updateprofile');
    Route::post('/passwordchangestore',[CustomerController::class,'passwordchangestore'])->name('customer#passwordchangestore');

    Route::get('/cart', [CartController::class, 'cart'])->name('customer#cart');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('customer#checkout');
    Route::post('/order/create', [OrderController::class, 'create'])->name('customer#ordercreate');
    Route::get('/confirmation/{orderid}', [OrderController::class, 'confirmation'])->name('customer#confirmation');

    //Reviews and Comments

    //Route::get('/products/{id}', )->name('products.show');
    Route::post('/products/{id}/reviews', [ReviewController::class,'storeReview'])->name('customer#storeReview');

    //Route::post('/reviews/{id}/comments', [ProductController::class,'storeComment'])->name('customer#storeComment');

    //Comment
    Route::post('/products/{id}/comments', [CommentController::class,'storeComment'])->name('customer#storeComment');
    Route::delete('/comments/{id}', [CommentController::class,'destroy'])->name('customer#comments.destroy');



    Route::post('/comments/{id}/like', [CommentController::class,'like'])->name('customer#comments.like');
    Route::delete('/comments/{id}/like', [CommentController::class,'unlike'])->name('customer#comments.unlike');
    Route::post('/products/{productId}/comments/{commentId}/reply-comments', [CommentController::class, 'storeReply'])->name('customer#reply-comments.store');




});

//Public Area
Route::get('/',[CustomerController::class,'index'])->name('customer#index');

Route::get('/contact',[CustomerController::class,'contact'])->name('customer#contact');
Route::get('signin',[CustomerController::class,'signin'])->name('customer#signin');
Route::get('signup',[CustomerController::class,'signup'])->name('customer#signup');
Route::get('product-category/{slug}',[CustomerController::class,'productcategoryslug'])->name('customer#productcategoryslug');
Route::get('product/{slug}',[CustomerController::class,'productdetail'])->name('customer#productdetail');

Route::get('/get-states',[CountryController::class,'getStates'])->name('customer#getStates');
Route::get('/get-townships/{state}',[StateController::class,'getTownships'])->name('customer#getTownships');




Route::prefix('ajax')->group(function(){
    Route::get('products',[AjaxController::class,'products'])->name('ajax#productslist');
    Route::post('/cart/add', [CartController::class, 'addcart'])->name('ajax#cartadd');
    Route::post('/cart/update', [CartController::class, 'update'])->name('ajax#cartupdate');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('ajax#cartremove');

});


//Login with facebook
// Facebook login
//Route::get('login/facebook', 'LoginController@redirectToFacebook')->name('customer#facebooklogin');
//Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookCallback')->name('customer#facebookcallback');
Route::get('login/facebook',[FacebookLoginController::class,'redirectToFacebook'])->name('customer#facebooklogin');
Route::get('login/facebook/callback',[FacebookLoginController::class,'handleFacebookCallback'])->name('customer#facebookcallback');
