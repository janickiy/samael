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
use App\RequestCredit;
use App\RequestTradeIn;
use App\CatalogMark;
use App\CatalogModel;
use App\CatalogModification;
use App\CatalogComplectation;
use App\CatalogParameterCategory;
use App\CatalogParameterValue;
use App\CatalogColor;
use App\Callback;

Route::model('users', User::class);
Route::model('settings', Setting::class);
Route::model('roles', Role::class);
Route::model('pages', Page::class);
Route::model('menus', Menu::class);
Route::model('reviews', UserReview::class);
Route::model('carmarks',CarMark::class);
Route::model('carmodels',CarModel::class);
Route::model('requestcredits', RequestCredit::class);
Route::model('requesttradeins', RequestTradeIn::class);
Route::model('marks', CatalogMark::class);
Route::model('models', CatalogModel::class);
Route::model('modifications', CatalogModification::class);
Route::model('complectations', CatalogComplectation::class);
Route::model('parametercategories', CatalogParameterCategory::class);
Route::model('parametervalues', CatalogParameterValue::class);
Route::model('colors', CatalogColor::class);
Route::model('callbacks', Callback::class);

Route::group(['prefix' => ''], function() {
    define('PATH_AVATARS','/uploads/avatars');
    define('PATH_SMALL_IMAGES','/uploads/images/small/');
    define('PATH_BIG_IMAGES','/uploads/images/big/');
    define('PATH_MARK','/uploads/mark/');
    define('PATH_MODEL','/uploads/model/');
    define('PATH_SETTINGS','/uploads/settings');
    define('PATH_SMALL_TRADEIN','/uploads/tardein/small/');
    define('PATH_BIG_TRADEIN','/uploads/tardein/big/');
    define('PATH_COLOR','/uploads/color/');
    define('PATH_CARS','/uploads/cars/');
});

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'FrontendController@index');
    Route::any('/auto', 'FrontendController@allAuto');
    Route::get('/auto/{mark}', 'FrontendController@mark');
    Route::get('/auto/{mark}/{model}', 'FrontendController@model');
    Route::get('/credit', 'FrontendController@credit');
    Route::post('/request-credit', 'FrontendController@requestCredit');
    Route::get('/tradein', 'FrontendController@tradeIn');
    Route::post('/request-tradein', 'FrontendController@requestTradein');
    Route::get('/reviews', 'FrontendController@reviews');
    Route::post('/reviews', 'FrontendController@reviewsSubmit');
    Route::get('/contacts', 'FrontendController@contact');
    Route::get('/news', 'FrontendController@allNews');
    Route::get('/news/{slug}', 'FrontendController@news');
    Route::get('/page/{slug}', 'FrontendController@staticPages');
    Route::any('/ajax', 'FrontendController@ajax');
    Route::get('/about', 'FrontendController@about');
    Route::get('/documents', 'FrontendController@documents');
    Route::get('/our_clients', 'FrontendController@our_clients');
    Route::post('/callback', 'FrontendController@callback');

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
        Route::get('carmarks/import', 'Admin\CarmarksController@import');
        Route::post('carmarks/imporcarmarks', 'Admin\CarmarksController@importCarmarks');
        Route::get('catalog/models/mark/{id}', 'Admin\CatalogmodelsController@catalogmark');
        Route::any('catalog/models/create/{id}', 'Admin\CatalogmodelsController@create');
        Route::get('catalog/models/model/{id}/modifications', 'Admin\CatalogmodelsController@modifications');
        Route::get('catalog/models/model/{id}/complectations', 'Admin\CatalogmodelsController@complectations');
        Route::get('catalog/models/model/{id}/packs', 'Admin\CatalogmodelsController@packs');
        Route::get('catalog/models/model/{id}/colors', 'Admin\CatalogmodelsController@colors');
        Route::get('catalog/modifications/create/{id}', 'Admin\CatalogmodificationsController@create');
        Route::get('catalog/colors/create/{id}', 'Admin\CatalogcolorsController@create');
        Route::get('catalog/parametervalues/category/{id}', 'Admin\CatalogparametervaluesController@category');
        Route::any('catalog/parametervalues/create/{id}', 'Admin\CatalogparametervaluesController@create');
        Route::any('catalog/complectations/create/{id}', 'Admin\CatalogcolorsController@create');
        Route::any('/ajax', 'Admin\DashboardController@ajax');
        Route::resource('users', 'Admin\UsersController');
        Route::get('settings/create/{type}', ['as' => 'admin.settings.create.type', 'uses' => 'Admin\SettingsController@createForm']);
        Route::get('settings/download/{settings}', ['as' => 'admin.settings.download', 'uses' => 'Admin\SettingsController@fileDownload']);
        Route::get('catalog/image-gallery/model/{id}', 'Admin\ImageGalleryController@index');
        Route::post('catalog/image-gallery', 'Admin\ImageGalleryController@upload');
        Route::delete('catalog/image-gallery/{id}', 'Admin\ImageGalleryController@destroy');

        Route::resource('settings', 'Admin\SettingsController');
        Route::resource('roles', 'Admin\RolesController');
        Route::resource('pages', 'Admin\PagesController');
        Route::resource('menus', 'Admin\MenusController');
        Route::resource('reviews', 'Admin\ReviewsController');
        Route::resource('carmarks', 'Admin\CarmarksController');
        Route::resource('carmodels', 'Admin\CarmodelsController');
        Route::resource('requestcredits', 'Admin\RequestCreditsController');
        Route::resource('requesttradeins', 'Admin\RequestTradeInsController');
        Route::resource('callbacks', 'Admin\CallbacksController');

        Route::group(['prefix' => 'catalog', 'middleware' => 'admin'], function () {

            Route::resource('marks', 'Admin\CatalogmarksController');
            Route::resource('models', 'Admin\CatalogmodelsController');
            Route::resource('modifications', 'Admin\CatalogmodificationsController');
            Route::resource('complectations', 'Admin\CatalogcomplectationsController');
            Route::resource('parametercategories', 'Admin\CatalogparametercategoriesController');
            Route::resource('parametervalues', 'Admin\CatalogparametervaluesController');
            Route::resource('colors', 'Admin\CatalogcolorsController');

        });
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