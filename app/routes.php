<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Register all the admin routes.
|
*/

Route::group(array('prefix' => 'admin', 'before' => 'auth', 'after' => 'no-cache'), function () {

	# Welcome
	Route::group(array('prefix' => 'welcome'), function () {
		Route::get('/', array('as' => 'welcome', 'uses' => 'WelcomeController@getIndex'));
	});

	# Dictionary
	Route::group(array('prefix' => 'dictionary'), function () {
		Route::get('/', array('as' => 'dictionary', 'uses' => 'PostController@getIndex'));
		Route::get('{postSlug}', array('as' => 'view-post', 'uses' => 'PostController@getView'));
		Route::post('{postSlug}', 'PostController@postView');
	});

	Route::group(array('prefix' => 'datatables'), function () {
		Route::get('/', array('as'=>'datatables', 'uses'=>'ImportController@getDatatable'));
		Route::get('partner/{partner_id}', array('as'=>'datatables/partner', 'uses'=>'ImportController@getPartnerDatatable'));
		//Route::get('partner/{partner_id}/column/{column_name_slug}', array('as'=>'datatables/partner/column', 'uses'=>'ImportController@getPartnerColumnDatatable'));
		Route::get('partner/{partner_id}/column/{column_name_slug}/table/{table_name}', array('as'=>'datatables/partner/column', 'uses'=>'ImportController@getPartnerColumnDatatable'));
		Route::get('statuses/{status_id}', array('as'=>'datatables/statuses', 'uses'=>'ImportController@getStatusesDatatable'));
	});

    # Import
    Route::group(array('prefix' => 'import', 'before' => 'admin-auth'), function () {
		  Route::get('/', array('as' => 'import', 'uses' => 'ImportController@getIndex'));
	    Route::get('create', array('as' => 'create/import', 'uses' =>'ImportController@getImport'));
			Route::post('create', 'ImportController@postImport');

			Route::get('missing', array('as' => 'missing', 'uses' =>'ImportController@getMissing'));
	    Route::post('upload',array('as' => 'upload', 'uses' => 'ImportController@toDatabase'));
	    Route::get('template', array('as' => 'template', 'uses' =>'ImportController@getTemplate'));
	    Route::get('example', array('as' => 'example', 'uses' =>'ImportController@getExample'));
			Route::get('{BatchId}/delete', array('as' => 'delete/import', 'uses' => 'ImportController@getDelete'));
			Route::get('{BatchId}/confirm-delete', array('as' => 'confirm-delete/import', 'uses' => 'ImportController@getModalDelete'));
    });

    # Post Management
    Route::group(array('prefix' => 'posts', 'before' => 'admin-auth'), function () {
    	  Route::get('/', array('as' => 'posts', 'uses' => 'Controllers\Admin\PostsController@getIndex'));
        Route::get('create', array('as' => 'create/post', 'uses' => 'Controllers\Admin\PostsController@getCreate'));
        Route::post('create', 'Controllers\Admin\PostsController@postCreate');
        Route::get('{blogId}/edit', array('as' => 'update/post', 'uses' => 'Controllers\Admin\PostsController@getEdit'));
        Route::post('{blogId}/edit', 'Controllers\Admin\PostsController@postEdit');
        Route::get('{blogId}/delete', array('as' => 'delete/post', 'uses' => 'Controllers\Admin\PostsController@getDelete'));
        Route::get('{blogId}/confirm-delete', array('as' => 'confirm-delete/post', 'uses' => 'Controllers\Admin\PostsController@getModalDelete'));
        Route::get('{blogId}/restore', array('as' => 'restore/post', 'uses' => 'Controllers\Admin\PostsController@getRestore'));
    });

    # licenses Management
    Route::group(array('prefix' => 'licenses'), function () {
        //Make so view only own license
        Route::get('{licenseId}/view', array('as' => 'view-license', 'uses' => 'LicenseController@getView'));

				Route::get('download', array('as' => 'download/license', 'uses' => 'Controllers\Admin\LicensesController@getWelcome'));				
				
				Route::get('create', array('as' => 'create/license', 'uses' => 'Controllers\Admin\LicensesController@getCreate'));
				Route::post('create', 'Controllers\Admin\LicensesController@licenseCreate');

				Route::get('/status', array('as' => 'status/license', 'uses' => 'Controllers\Admin\LicensesController@getStatus'));
    });
    Route::group(array('prefix' => 'licenses', 'before' => 'admin-auth'), function () {
        Route::get('/', array('as' => 'licenses', 'uses' => 'Controllers\Admin\LicensesController@getIndex'));

        Route::get('{licenseId}/edit', array('as' => 'update/license', 'uses' => 'Controllers\Admin\LicensesController@getEdit'));
        Route::post('{licenseId}/edit', 'Controllers\Admin\LicensesController@licenseEdit');
        Route::get('{licenseId}/delete', array('as' => 'delete/license', 'uses' => 'Controllers\Admin\LicensesController@getDelete'));
        Route::get('{licenseId}/confirm-delete', array('as' => 'confirm-delete/license', 'uses' => 'Controllers\Admin\LicensesController@getModalDelete'));
        Route::get('{licenseId}/restore', array('as' => 'restore/license', 'uses' => 'Controllers\Admin\LicensesController@getRestore'));
    });


    # User Management
    Route::group(array('prefix' => 'users', 'before' => 'admin-auth'), function () {
        Route::get('/', array('as' => 'users', 'uses' => 'Controllers\Admin\UsersController@getIndex'));
        Route::get('create', array('as' => 'create/user', 'uses' => 'Controllers\Admin\UsersController@getCreate'));
        Route::post('create', 'Controllers\Admin\UsersController@postCreate');
        Route::get('{userId}/edit', array('as' => 'update/user', 'uses' => 'Controllers\Admin\UsersController@getEdit'));
        Route::post('{userId}/edit', 'Controllers\Admin\UsersController@postEdit');
        Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'Controllers\Admin\UsersController@getDelete'));
        Route::get('{userId}/confirm-delete', array('as' => 'confirm-delete/user', 'uses' => 'Controllers\Admin\UsersController@getModalDelete'));
        Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'Controllers\Admin\UsersController@getRestore'));
        Route::get('{userId}/unsuspend', array('as' => 'unsuspend/user', 'uses' => 'Controllers\Admin\UsersController@getUnsuspend'));
    });

    # Group Management
    Route::group(array('prefix' => 'groups', 'before' => 'admin-auth'), function () {
        Route::get('/', array('as' => 'groups', 'uses' => 'Controllers\Admin\GroupsController@getIndex'));
        Route::get('create', array('as' => 'create/group', 'uses' => 'Controllers\Admin\GroupsController@getCreate'));
        Route::post('create', 'Controllers\Admin\GroupsController@postCreate');
        Route::get('{groupId}/edit', array('as' => 'update/group', 'uses' => 'Controllers\Admin\GroupsController@getEdit'));
        Route::post('{groupId}/edit', 'Controllers\Admin\GroupsController@postEdit');
        Route::get('{groupId}/delete', array('as' => 'delete/group', 'uses' => 'Controllers\Admin\GroupsController@getDelete'));
        Route::get('{groupId}/confirm-delete', array('as' => 'confirm-delete/group', 'uses' => 'Controllers\Admin\GroupsController@getModalDelete'));
        Route::get('{groupId}/restore', array('as' => 'restore/group', 'uses' => 'Controllers\Admin\GroupsController@getRestore'));
    });

    # Dashboard
    Route::get('/', array('as' => 'admin', 'uses' => 'Controllers\Admin\DashboardController@getIndex'));

});

/*
|--------------------------------------------------------------------------
| Authentication and Authorization Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::group(array('prefix' => 'auth'), function () {

    # Login
    Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
    Route::post('signin', 'AuthController@postSignin');

    # Register
    Route::get('signup', array('as' => 'signup', 'uses' => 'AuthController@getSignup'));
    Route::post('signup', 'AuthController@postSignup');

    # Account Activation
    Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));

    # Forgot Password
    Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@getForgotPassword'));
    Route::post('forgot-password', 'AuthController@postForgotPassword');

    # Forgot Password Confirmation
    Route::get('forgot-password/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
    Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

    # Logout
    Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout', 'after' => 'no-cache'));

});

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::group(array('prefix' => 'account'), function () {

    # Account Dashboard
    Route::get('/', array('as' => 'account', 'uses' => 'Controllers\Account\DashboardController@getIndex'));

    # Profile
    Route::get('profile', array('as' => 'profile', 'uses' => 'Controllers\Account\ProfileController@getIndex'));
    Route::post('profile', 'Controllers\Account\ProfileController@postIndex');

    # Change Password
    Route::get('change-password', array('as' => 'change-password', 'uses' => 'Controllers\Account\ChangePasswordController@getIndex'));
    Route::post('change-password', 'Controllers\Account\ChangePasswordController@postIndex');

    # Change Email
    Route::get('change-email', array('as' => 'change-email', 'uses' => 'Controllers\Account\ChangeEmailController@getIndex'));
    Route::post('change-email', 'Controllers\Account\ChangeEmailController@postIndex');

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is licenseed.
|
*/

//Route::get('about-us', function () {
//   return View::make('frontend/about-us');
//});

//Route::get('faq', function () {
//    return View::make('frontend/faq');
//});

//Route::get('contact-us', array('as' => 'contact-us', 'uses' => 'ContactUsController@getIndex'));
//Route::post('contact-us', 'ContactUsController@postIndex');

//Route::get('partners', array('as' => 'partners', 'uses' => 'PartnersController@getIndex'));

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));

//Route::get('/', ['as' => 'home', function()
//{
//    return View::make('frontend/home');
//}]);


//Route::get('/', array('as' => 'home', 'uses' => 'PostController@getIndex'));
//Route::get('home', array('as' => 'home', 'uses' => 'PostController@getIndex'));

//Route::get('export', array('as' => 'xls', 'uses' => 'PostController@xlsImport'));

//Route::get('import/data', 'ImportController@getData');


Route::group(array('prefix' => 'api'), function() {
	Route::resource('datastatus', 'DataStatusController');
});  
