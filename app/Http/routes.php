<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */

use App\User;
use App\Setting;
use App\Role;
use App\Page;
use App\Menu;
use App\UserReview;
use App\CarMark;
use App\CarModel;
use App\CarModification;
use App\CatalogUsedCar;
use App\Image;
use App\RequestCredit;
use App\RequestTradeIn;
use App\RequestUsedcarCredit;
use App\Callback;

Route::model('users', User::class);
Route::model('settings', Setting::class);
Route::model('roles', Role::class);
Route::model('pages', Page::class);
Route::model('menus', Menu::class);
Route::model('reviews', UserReview::class);
Route::model('carmarks',CarMark::class);
Route::model('carmodels',CarModel::class);
Route::model('carmodifications',CarModification::class);
Route::model('catalogusedcars', CatalogUsedCar::class);
Route::model('images', Image::class);
Route::model('requestcredits', RequestCredit::class);
Route::model('requesttradeins', RequestTradeIn::class);
Route::model('requestusedcarcredits', RequestUsedcarCredit::class);
Route::model('callbacks', Callback::class);

Route::group(['prefix' => ''], function() {
    define('PATH_AVATARS','/uploads/avatars');
    define('PATH_SMALL_IMAGES','/uploads/images/small/');
    define('PATH_BIG_IMAGES','/uploads/images/big/');
    define('PATH_MARK','/uploads/mark/');
    define('PATH_MODEL','/uploads/model/');
    define('PATH_SETTINGS','/uploads/settings');
    define('PATH_SMALL_USEDCARS','/uploads/usedcars/small/');
    define('PATH_BIG_USEDCARS','/uploads/usedcars/big/');
    define('PATH_SMALL_TRADEIN','/uploads/tardein/small/');
    define('PATH_BIG_TRADEIN','/uploads/tardein/big/');
});

Route::group(['middleware' => ['web']], function () {

    Route::any('/', 'FrontendController@index');
    Route::get('/auto/used', 'FrontendController@allUsedAuto');
    Route::any('/auto/used/allmarks', 'FrontendController@allmarks');
    Route::get('/auto/used/detail/{id}', 'FrontendController@usedAutoDetail');
    Route::get('/auto/used/{mark}', 'FrontendController@usedAuto');
    Route::get('/auto/used/{mark}/{model}', 'FrontendController@usedAutoModel');
    Route::get('/credit', 'FrontendController@credit');
    Route::post('/request-credit', 'FrontendController@requestCredit');
    Route::post('/usedcar-request-credit', 'FrontendController@requestUsedCarCredit');
    Route::get('/tradein', 'FrontendController@tradeIn');
    Route::post('/request-tradein', 'FrontendController@requestTradein');
    Route::get('/reviews', 'FrontendController@reviews');
    Route::post('/reviews', 'FrontendController@reviewsSubmit');
    Route::get('/contacts', 'FrontendController@contact');
    Route::post('/contacts', 'FrontendController@contactUsSubmit');
    Route::post('/callback', 'FrontendController@callback');
    Route::get('/page/{slug}', 'FrontendController@staticPages');
    Route::any('/ajax', 'FrontendController@ajax');

});

Route::group(['middleware' => 'web'], function () {
    /**
     * Authentication routes
     */
    Route::auth();
    /**
     * Admin routes
     */
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

        Route::controllers([
            'datatables' => 'Admin\DatatablesController',
        ]);

        Route::get('/dashboard', 'Admin\DashboardController@index');
        Route::get('carmodels/carmark/{id}', 'Admin\CarmodelsController@carmark');
        Route::any('carmodels/create/{id}', 'Admin\CarmodelsController@create');
        Route::get('carmodifications/model/{id}', 'Admin\CarmodificationsController@index');
        Route::get('carmodifications/create/{id}', 'Admin\CarmodificationsController@create');
        Route::get('carmarks/import', 'Admin\CarmarksController@import');
        Route::post('carmarks/imporcarmarks', 'Admin\CarmarksController@importCarmarks');
        Route::any('/ajax', 'Admin\DashboardController@ajax');
        Route::resource('users', 'Admin\UsersController');
        Route::get('settings/create/{type}', ['as' => 'admin.settings.create.type', 'uses' => 'Admin\SettingsController@createForm']);
        Route::get('settings/download/{settings}', ['as' => 'admin.settings.download', 'uses' => 'Admin\SettingsController@fileDownload']);
        Route::resource('settings', 'Admin\SettingsController');
        Route::resource('roles', 'Admin\RolesController');
        Route::resource('pages', 'Admin\PagesController');
        Route::resource('menus', 'Admin\MenusController');
        Route::resource('reviews', 'Admin\ReviewsController');
        Route::resource('carmarks', 'Admin\CarmarksController');
        Route::resource('carmodels', 'Admin\CarmodelsController');
        Route::resource('carmodifications', 'Admin\CarmodificationsController');
        Route::resource('catalogusedcars', 'Admin\CatalogUsedCarsController');
        Route::resource('images', 'Admin\ImagesController');
        Route::resource('requestcredits', 'Admin\RequestCreditsController');
        Route::resource('requestusedcarcredits', 'Admin\RequestUsedcarCreditsController');
        Route::resource('requesttradeins', 'Admin\RequestTradeInsController');
        Route::resource('callbacks', 'Admin\CallbacksController');
    });

    /**
     * Member routes
     */
    Route::group(['prefix' => 'member'], function () {
        Route::get('/home', ['as' => 'member.home', 'uses' => 'MemberController@index']);
        Route::get('/profile', ['as' => 'member.profile', 'uses' => 'MemberController@profile']);
        Route::get('/profile/edit', ['as' => 'member.profile.edit', 'uses' => 'MemberController@editProfile']);
        Route::put('/profile/edit', ['as' => 'member.profile.update', 'uses' => 'MemberController@updateProfile']);
    });
	
	Route::get('sitemap', function(){

		// create new sitemap object
		$sitemap = App::make("sitemap");

		// set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
		// by default cache is disabled
		$sitemap->setCache('laravel.sitemap', 1440);

		// check if there is cached sitemap and build new only if is not
		if (!$sitemap->isCached()) {
			 $posts = DB::table('pages')->orderBy('created_at', 'desc')->get();

			 // add every post to the sitemap
			 foreach ($posts as $post)
			 {
				if ($post->blog_post ) {
					$slug = "blog/".$post->slug;
				} else {
					$slug = "page/".$post->slug;
				}
				$sitemap->add(URL::to($slug), $post->updated_at,'0.9', 'daily');
			 }
		}

		return $sitemap->render('xml');

	});
});
