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
View::composer('site.layout', function ($view) {
    $view->with('langs',  \App\Models\Language::all());
    $view->with('categories',  \App\Models\Category::take(6)->get());
    $view->with('last_ads', \App\Models\Product::where('status','accepted')->orderBy('id', 'desc')->take(5)->get());
});



Route::middleware(['auth','role:admin|super-admin'])->prefix('admin')->group(function() {
    Route::get('/','Admin\AdminController@index')->name('admin.home');


    Route::Resource('user', 'Admin\UserController');
    Route::Resource('language', 'Admin\LanguageController');
    Route::Resource('city', 'Admin\CityController');
    Route::Resource('category', 'Admin\CategoryController');
    Route::Resource('platform', 'Admin\PlatformController');
    Route::Resource('period', 'Admin\PeriodController');
    Route::Resource('product', 'Admin\ProductController');
    Route::Resource('discussion-category', 'Admin\DiscussionCategoryController');
    Route::Resource('discussion', 'Admin\DiscussionController');
    Route::Resource('discussion-comment', 'Admin\DiscussionCommentsController');
    Route::Resource('payment-method', 'Admin\PaymentMethodController');

});

Route::get('/', 'Frontend\SiteController@index')->name('site.home');
Route::get('/product/{slug}', 'Frontend\SiteController@product')->name('site.product');
Route::get('/add-advert', 'Frontend\SiteController@addAdvert')->name('site.add-advert');
Route::get('/payments', 'Frontend\SiteController@payments')->name('site.payments');

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::post('/site/setlocale', 'Frontend\SiteController@setLocale');
Route::post('/create-ads', 'Frontend\SiteController@createAds')->name('site.create-ads');
Route::post('/update-profile', 'Frontend\SiteController@updateProfile')->name('site.update-profile');
Route::post('/forum/{id}/{slug}', 'Frontend\SiteController@addComment')->name('site.add-comment');
Route::post('/add-discussion', 'Frontend\SiteController@addDiscussion')->name('site.add-discussion');
Route::post('/site/filter-products', 'Frontend\SiteController@filterProducts')->name('site.filter-products');
Route::post('/user-update-ads', 'Frontend\SiteController@updateUserAdvert')->name('site.user-update-ads');

Route::get('/forum', 'Frontend\SiteController@forum')->name('site.forum');
Route::get('/create-discussion', 'Frontend\SiteController@createDiscussion')->name('site.create-discussion');
Route::get('/my-profile', 'Frontend\SiteController@profile')->name('site.my-profile');
Route::get('/categories', 'Frontend\SiteController@categories')->name('site.categories');
Route::get('/consoles', 'Frontend\SiteController@consoles')->name('site.consoles');
Route::get('/user-advert/{id}', 'Frontend\SiteController@userAdvert')->name('site.user-advert');
Route::get('/forum/{id}/{slug}', 'Frontend\SiteController@forumInner')->name('site.forum-inner');

Route::get('/cat/{id}/products', 'Frontend\SiteController@categoryProducts')->name('site.cat-products');
Route::get('/console/{id}/products', 'Frontend\SiteController@consoleProducts')->name('site.console-products');
//Route::get('/redirect', 'Auth\SocialAuthFacebookController@redirect');
//Route::get('/callback', 'Auth\SocialAuthFacebookController@callback');

Route::get('/advertisements', 'Frontend\SiteController@advertisements')->name('site.all-ads');
