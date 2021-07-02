<?php

use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use Foostart\Category\Helpers\FooCategory;
use Foostart\Category\Helpers\SortTable;

/*
|-----------------------------------------------------------------------
| GLOBAL VARIABLES
|-----------------------------------------------------------------------
|   $sidebar_items
|   $sorting
|   $order_by
|   $plang_admin = 'diary-admin'
|   $plang_front = 'diary-front'
*/
View::composer([
                'package-diary::admin.diary-edit',
                'package-diary::admin.diary-form',
                'package-diary::admin.diary-items',
                'package-diary::admin.diary-item',
                'package-diary::admin.diary-search',
                'package-diary::admin.diary-config',
                'package-diary::admin.diary-lang',
    ], function ($view) {

        //Order by params
        $params = Request::all();

        /**
         * $plang-admin
         * $plang-front
         */

        $plang_admin = 'diary-admin';
        $plang_front = 'diary-front';

        $fooCategory = new FooCategory();
        $key = $fooCategory->getContextKeyByRef('admin/diaries');

        /**
         * $sidebar_items
         */
        $sidebar_items = [
            trans('diary-admin.sidebar.add') => [
                'url' => URL::route('diaries.edit', []),
                'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            ],
            trans('diary-admin.sidebar.list') => [
                "url" => URL::route('diaries.list', []),
                'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('diary-admin.sidebar.category') => [
                'url'  => URL::route('categories.list',['_key='.$key]),
                'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
            ],
            trans('diary-admin.sidebar.config') => [
                "url" => URL::route('diaries.config', []),
                'icon' => '<i class="fa fa-braille" aria-hidden="true"></i>'
            ],
            trans('diary-admin.sidebar.lang') => [
                "url" => URL::route('diaries.lang', []),
                'icon' => '<i class="fa fa-language" aria-hidden="true"></i>'
            ],
        ];

        /**
         * $sorting
         * $order_by
         */
        $orders = [
            '' => trans($plang_admin.'.form.no-selected'),
            'id' => trans($plang_admin.'.fields.id'),
            'diary_name' => trans($plang_admin.'.fields.name'),
            'status' => trans($plang_admin.'.columns.status'),
            'updated_at' => trans($plang_admin.'.fields.updated_at'),
        ];
        $sortTable = new SortTable();
        $sortTable->setOrders($orders);
        $sorting = $sortTable->linkOrders();



        //Order by
        $order_by = [
            'asc' => trans('category-admin.order.by-asc'),
            'desc' => trans('category-admin.order.by-des'),
        ];

        // assign to view
        $view->with('sidebar_items', $sidebar_items );
        $view->with('order_by', $order_by);
        $view->with('sorting', $sorting);
        $view->with('plang_admin', $plang_admin);
        $view->with('plang_front', $plang_front);
});
