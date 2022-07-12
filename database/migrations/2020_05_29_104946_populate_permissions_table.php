<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class PopulatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            ['title' => 'permissions_create'],
            ['title' => 'permissions_edit'],
            ['title' => 'permissions_show'],
            ['title' => 'permissions_delete'],
            ['title' => 'permissions_access'],

            ['title' => 'user_create'],
            ['title' => 'user_edit'],
            ['title' => 'user_show'],
            ['title' => 'user_delete'],
            ['title' => 'user_access'],

            ['title' => 'roles_create'],
            ['title' => 'roles_edit'],
            ['title' => 'roles_show'],
            ['title' => 'roles_delete'],
            ['title' => 'roles_access'],

            ['title' => 'translations_access'],

            ['title' => 'menus_create'],
            ['title' => 'menus_edit'],
            ['title' => 'menus_show'],
            ['title' => 'menus_delete'],
            ['title' => 'menus_access'],

            ['title' => 'categories_create'],
            ['title' => 'categories_edit'],
            ['title' => 'categories_show'],
            ['title' => 'categories_delete'],
            ['title' => 'categories_access'],

            ['title' => 'companies_create'],
            ['title' => 'companies_edit'],
            ['title' => 'companies_show'],
            ['title' => 'companies_delete'],
            ['title' => 'companies_access'],

            ['title' => 'pages_create'],
            ['title' => 'pages_edit'],
            ['title' => 'pages_show'],
            ['title' => 'pages_delete'],
            ['title' => 'pages_access'],

            ['title' => 'news_create'],
            ['title' => 'news_edit'],
            ['title' => 'news_show'],
            ['title' => 'news_delete'],
            ['title' => 'news_access'],

            ['title' => 'feedbacks_create'],
            ['title' => 'feedbacks_edit'],
            ['title' => 'feedbacks_show'],
            ['title' => 'feedbacks_delete'],
            ['title' => 'feedbacks_access'],

            ['title' => 'statuses_create'],
            ['title' => 'statuses_edit'],
            ['title' => 'statuses_show'],
            ['title' => 'statuses_delete'],
            ['title' => 'statuses_access'],
        ];

        DB::table('permissions')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
