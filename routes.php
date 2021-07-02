<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT
 */
Route::get('post', [
    'as' => 'diary',
    'uses' => 'Foostart\Diary\Controllers\Front\DiaryFrontController@index'
]);


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
                  'namespace' => 'Foostart\Diary\Controllers\Admin',
        ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage Diary
          |-----------------------------------------------------------------------
          | 1. List of diaries
          | 2. Edit Diary
          | 3. Delete Diary
          | 4. Add new Diary
          | 5. Manage configurations
          | 6. Manage languages
          |
        */

        /**
         * list
         */
        Route::get('admin/diaries', [
            'as' => 'diaries.list',
            'uses' => 'DiaryAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/diaries/edit', [
            'as' => 'diaries.edit',
            'uses' => 'DiaryAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/diaries/copy', [
            'as' => 'diaries.copy',
            'uses' => 'DiaryAdminController@copy'
        ]);

        /**
         * Diary
         */
        Route::post('admin/diaries/edit', [
            'as' => 'diaries.diary',
            'uses' => 'DiaryAdminController@diary'
        ]);

        /**
         * delete
         */
        Route::get('admin/diaries/delete', [
            'as' => 'diaries.delete',
            'uses' => 'DiaryAdminController@delete'
        ]);

        /**
         * trash
         */
         Route::get('admin/diaries/trash', [
            'as' => 'diaries.trash',
            'uses' => 'DiaryAdminController@trash'
        ]);

        /**
         * configs
        */
        Route::get('admin/diaries/config', [
            'as' => 'diaries.config',
            'uses' => 'DiaryAdminController@config'
        ]);

        Route::post('admin/diaries/config', [
            'as' => 'diaries.config',
            'uses' => 'DiaryAdminController@config'
        ]);

        /**
         * language
        */
        Route::get('admin/diaries/lang', [
            'as' => 'diaries.lang',
            'uses' => 'DiaryAdminController@lang'
        ]);

        Route::post('admin/diaries/lang', [
            'as' => 'diaries.lang',
            'uses' => 'DiaryAdminController@lang'
        ]);

    });
});
