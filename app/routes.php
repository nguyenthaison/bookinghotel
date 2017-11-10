<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/home', 'HomeController@index');

// Route::get('/', 'HomeController@index');
Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/contact-us', function () {
    return view('contact');
});*/
Route::get('/contact', 'ContactController@postSubmit');

Route::get('thumb-detail/{original_name}/{width}', [
	'as' => 'thumbDetail', 'uses' => 'VillaController@images']);


Route::get('area/{area}', [
	'as' => 'area', 'uses' => 'AreaController@index']);
Route::get('getarea/{id}', array('as' => 'api.area', 
			'uses' => 'AreaController@apiGetVillaByArea'));

// Route::get('/', function () {
//     return view('HomeController@index');
// });

// API > Reviews > By villa
Route::get('reviews/{id}/list', array('as' => 'api.reviews.list', 
	'uses' => 'Admin\ReviewController@apiGetReviewsByVilla'));

// API > Reviews > By villa
Route::get('villa-gallery/{id}/list', array('as' => 'api.gallery.list', 
	'uses' => 'VillaController@apiGetGallery'));

Route::get('original-image/{original_name}/detail', [
	'as' => 'originalImages', 'uses' => 'VillaController@getOriginalImages']);

Route::get('gallery/thumb/{original_name}/{width}', [
	'as' => 'thumbImages', 'uses' => 'Admin\GalleryController@thumbImages']);

Route::get('thumb/{original_name}/{width}/{page_name}', [
	'as' => 'thumbnail', 'uses' => 'HomeController@thumbnail']);

Route::get('unauthorized', ['as' => 'unauthorized', function () {
	return view('admin.errors.unauthorized');
}]);

// Admin Routes

Route::group(['prefix' => env('ADMIN_URL'), 'middleware' => 'auth'], function () {

	// Dashboard

	Route::get('/', function () {
			return view('admin.dashboard');
	});


	// Bedrooms
	Route::resource('bedroom', 'Admin\BedroomController');

	// Country
	Route::resource('country', 'Admin\CountryController');

	// Region
	Route::resource('region', 'Admin\RegionController');

	// Area
	Route::resource('area', 'Admin\AreaController');

	// Season
	Route::resource('season', 'Admin\SeasonController');

	// Environments
	Route::resource('environment', 'Admin\EnvironmentController');

	// Role
	Route::resource('role', 'Admin\RoleController');

	// Assign Permission to Role > List Roles
	Route::get('assignment', ['as' => env('ADMIN_URL').'.assignment', 
					'uses' => 'Admin\RoleController@listRoles']);

	// Assign Permission to Role > List permissions of a role
	Route::get('assignment/{id}/edit', ['as' => env('ADMIN_URL').'.assignment.edit', 
					'uses' => 'Admin\RoleController@getPermissions']);

	// Assign Permission to Role > assign permissions to a role
	Route::post('assignment', ['as' => env('ADMIN_URL').'.assignment.store', 
					'uses' => 'Admin\RoleController@storePermissions']);

	// Permission
	Route::resource('permission', 'Admin\PermissionController');

	// Rate
	Route::post('rates', array('as' => env('ADMIN_URL').'.rates.store', 
		'uses' => 'Admin\RateController@store'));

	// Gallery
	Route::resource('gallery', 'Admin\GalleryController');

	// Gallery -> Delete Modal
	Route::get('gallery-modal', ['as' => env('ADMIN_URL').'.gallery.deletemodal', function () {
		return view('admin.modal.deleteGallery_modal');
	}]);

	// Gallery Group
	Route::resource('gallery-group', 'Admin\GalleryGroupController');

	// User
	Route::resource('user', 'Admin\UserController');

	// Reviews
	Route::resource('reviews', 'Admin\ReviewController');
	Route::get('reviews/{id}/approve', array('as' => env('ADMIN_URL').'.reviews.approve',
		'uses' => 'Admin\ReviewController@approve'));
	Route::get('reviews-modal', ['as' => env('ADMIN_URL').'.reviews.reviewsmodal', function () {
		return view('admin.modal.deleteReviews_modal');
	}]);

	// Reviews
	Route::resource('testimonial', 'Admin\TestimonialController');
	Route::get('testimonial/{id}/approve', array('as' => env('ADMIN_URL').'.testimonial.approve',
		'uses' => 'Admin\TestimonialController@approve'));
	Route::get('testimonial-modal', ['as' => env('ADMIN_URL').'.testimonial.testimonialmodal', function () {
		return view('admin.modal.deleteTestimonial_modal');
	}]);

	// Villa
	Route::resource('villa', 'Admin\VillaController');
	Route::get('villa/{id}/rates', array('as' => env('ADMIN_URL').'.villa.rates',
		'uses' => 'Admin\VillaController@rates'));
	Route::get('villa/{id}/gallery', array('as' => env('ADMIN_URL').'.villa.gallery',
		'uses' => 'Admin\VillaController@gallery'));	
	Route::get('villa-modal', ['as' => env('ADMIN_URL').'.villa.deletemodal', function () {
		return view('admin.modal.deleteVilla_modal');
	}]);

	// Special Offers
	Route::get('special-offers', array('as' => env('ADMIN_URL').'.specialoffers.index',
		'uses' => 'Admin\VillaController@SpecialOffers'));
	Route::get('special-offers/create', array('as' => env('ADMIN_URL').'.specialoffers.create',
		'uses' => 'Admin\VillaController@createSpecialOffers'));
	Route::get('special-offers/{id}/edit', array('as' => env('ADMIN_URL').'.specialoffers.edit',
		'uses' => 'Admin\VillaController@editSpecialOffers'));
	Route::put('special-offers/{id}', array('as' => env('ADMIN_URL').'.specialoffers.update',
		'uses' => 'Admin\VillaController@updateSpecialOffers'));
	Route::post('special-offers', array('as' => env('ADMIN_URL').'.specialoffers.store',
		'uses' => 'Admin\VillaController@postSpecialOffers'));
	Route::delete('special-offers/{id}', array('as' => env('ADMIN_URL').'.specialoffers.destroy',
		'uses' => 'Admin\VillaController@deleteSpecialOffers'));
	Route::get('offers-modal', ['as' => env('ADMIN_URL').'.specialoffers.deletemodal', function () {
		return view('admin.modal.deleteOffers_modal');
	}]);

	// Profile
	Route::resource('profile', 'Admin\ProfileController');
	Route::put('profile/changepwd/{id}', ['as' => env('ADMIN_URL').'profile.changepwd', 'uses' => 'Admin\ProfileController@changepwd']);

	// Admin API
	Route::group(['prefix' => 'api'], function () {

		// API > Country > List
		Route::get('countries', array('as' => env('ADMIN_URL').'.api.countries', 
			'uses' => 'Admin\RegionController@apiCountries'));

		// API > Bedroom > List
		Route::get('bedroom', array('as' => env('ADMIN_URL').'.api.bedroom', 
			'uses' => 'Admin\BedroomController@getApiBedroom'));

		// API > Environment > List
		Route::get('environment', array('as' => env('ADMIN_URL').'.api.environment', 
			'uses' => 'Admin\EnvironmentController@getApiEnvironment'));

		// API > Season > List
		Route::get('season', array('as' => env('ADMIN_URL').'.api.season', 
			'uses' => 'Admin\SeasonController@getApiSeason'));

		// API > Gallery Group > List
		Route::get('gallery-group', array('as' => env('ADMIN_URL').'.api.gallery-group', 
			'uses' => 'Admin\GalleryGroupController@getApiGalleryGroup'));

		// API > Gallery > List
		Route::get('gallery/{id}/list', array('as' => env('ADMIN_URL').'.api.gallery', 
			'uses' => 'Admin\GalleryController@apiGetGallery'));

		// API > Area > List
		Route::get('area', array('as' => env('ADMIN_URL').'.api.area', 
			'uses' => 'Admin\AreaController@getApiArea'));

		// API > Villa > List
		Route::get('villa', array('as' => env('ADMIN_URL').'.api.villa', 
			'uses' => 'Admin\VillaController@apiGetVillaList'));

		// API > Villa > Exist
		Route::get('villa/{value}/exist', array('as' => env('ADMIN_URL').'.api.villa.exist', 
			'uses' => 'Admin\VillaController@ifVillaExist'));

		// API > Villa > View by ID
		Route::get('villa/{id}/edit', array('as' => env('ADMIN_URL').'.api.villa.edit', 
			'uses' => 'Admin\VillaController@apiGetVilla'));

		// API > Villa Bedrooms > View by ID
		Route::get('villa/{id}/bedrooms', array('as' => env('ADMIN_URL').'.api.villa.bedrooms', 
			'uses' => 'Admin\VillaController@apiGetVillaBedrooms'));

		// API > Reviews > List
		Route::get('reviews', array('as' => env('ADMIN_URL').'.api.reviews', 
			'uses' => 'Admin\ReviewController@apiGetReviews'));

		// API > Reviews > List
		Route::get('testimonial', array('as' => env('ADMIN_URL').'.api.testimonial', 
			'uses' => 'Admin\TestimonialController@apiGetTestimonial'));

		// API > Special Offers > List
		Route::get('special-offers', array('as' => env('ADMIN_URL').'.api.specialoffers', 
			'uses' => 'Admin\VillaController@apiGetSpecialOffers'));

		// API > Special Offers > Edit
		Route::get('special-offers/{id}/edit', array('as' => env('ADMIN_URL').'.api.specialoffers.edit', 
			'uses' => 'Admin\VillaController@apiEditSpecialOffers'));

		// API > Rates > View by villa_id
		Route::get('rates/{id}/villa', array('as' => env('ADMIN_URL').'.api.rates.villa', 
			'uses' => 'Admin\RateController@apiGetVillaRates'));

	});

});


Route::get('{slug1}/{slug2}', [
	'as' => 'villa.detail', 
	'uses' => 'VillaController@index']
	)->where('slug1', '(.*)')
     ->where('slug2', '(.*)');
