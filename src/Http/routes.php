<?php

/* Admin routings */
Route::group(['namespace' => 'Hlacos\\LaraMvcms\\Http\\Controllers', 'prefix' => 'lara-mvcms', 'middleware' => 'lara-mvcms.is-admin'], function () {
    /* Logouted routings */
    Route::resource('sessions', 'SessionController', ['only' => ['create', 'store']]);
    //Route::resource('reset-password', 'ResetPasswordController', ['only' => ['create', 'store', 'edit', 'destroy']]);
    Route::get('reset-password', ['as' => 'lara-mvcms.reset-password.create', 'uses' => 'ResetPasswordController@getEmail']);
    Route::post('reset-password', ['as' => 'lara-mvcms.reset-password.store', 'uses' => 'ResetPasswordController@postEmail']);
    Route::get('reset-password/{token}', ['as' => 'lara-mvcms.reset-password.update', 'uses' => 'ResetPasswordController@getReset']);
    Route::delete('reset-password', ['as' => 'lara-mvcms.reset-password.delete', 'uses' => 'ResetPasswordController@postReset']);

    /* Logined routings */
    Route::group(['middleware' => 'lara-mvcms.admin'], function () {
        Route::resource('sessions', 'SessionController', ['only' => ['destroy']]);

        Route::get('/', ['as' => 'lara-mvcms.dashboard', function () {
            return view('lara-mvcms::dashboard');
        }]);

        Route::group(['namespace' => 'Administration', 'prefix' => 'administration'], function() {
            Route::get('permissions/{permissionId}/delete', [
                'as' => 'lara-mvcms.administration.permissions.delete',
                'uses' => 'PermissionController@delete'
            ]);
            Route::resource('permissions', 'PermissionController');

            Route::get('roles/{roleId}/delete', [
                'as' => 'lara-mvcms.administration.roles.delete',
                'uses' => 'RoleController@delete'
            ]);
            Route::resource('roles', 'RoleController');

            Route::get('admin-users/{userId}/delete', [
                'as' => 'lara-mvcms.administration.admin-users.delete',
                'uses' => 'AdminUserController@delete'
            ]);
            Route::resource('admin-users', 'AdminUserController');
        });

        Route::group(['namespace' => 'ContentManagement', 'prefix' => 'content-management'], function() {
            Route::get('pages/{pageId}/delete', [
                'as' => 'lara-mvcms.content-management.pages.delete',
                'uses' => 'PageController@delete'
            ]);
            Route::resource('pages', 'PageController');

            Route::get('entries/{entryId}/delete', [
                'as' => 'lara-mvcms.content-management.entries.delete',
                'uses' => 'EntryController@delete'
            ]);
            Route::resource('entries', 'EntryController');

            Route::get('galleries/{galleryId}/delete', [
                'as' => 'lara-mvcms.content-management.galleries.delete',
                'uses' => 'GalleryController@delete'
            ]);
            Route::resource('galleries', 'GalleryController');
        });

        Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function() {
            Route::get('posts/{postId}/delete', [
                'as' => 'lara-mvcms.blog.posts.delete',
                'uses' => 'PostController@delete'
            ]);
            Route::resource('posts', 'PostController');

            Route::get('categories/{categoryId}/delete', [
                'as' => 'lara-mvcms.blog.categories.delete',
                'uses' => 'CategoryController@delete'
            ]);
            Route::resource('categories', 'CategoryController');

            Route::get('tags/{tagId}/delete', [
                'as' => 'lara-mvcms.blog.tags.delete',
                'uses' => 'TagController@delete'
            ]);
            Route::resource('tags', 'TagController');
        });
    });
});
