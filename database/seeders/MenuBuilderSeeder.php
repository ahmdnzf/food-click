<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuBuilderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_menus = array(
            array(
                "id" => 1,
                "name" => "main_menu",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 2,
                "name" => "footer_menu_one",
                "created_at" => "2024-11-20 16:56:32",
                "updated_at" => "2024-11-20 16:56:32",
            ),
            array(
                "id" => 3,
                "name" => "footer_menu_two",
                "created_at" => "2024-11-20 16:57:04",
                "updated_at" => "2024-11-20 16:57:04",
            ),
            array(
                "id" => 4,
                "name" => "footer_menu_three",
                "created_at" => "2024-11-20 16:57:27",
                "updated_at" => "2024-11-20 16:57:27",
            ),
        );

        $admin_menu_items = array(
            array(
                "id" => 1,
                "label" => "Home",
                "link" => "/",
                "parent_id" => 0,
                "sort" => 0,
                "class" => NULL,
                "menu_id" => 2,
                "depth" => 0,
                "created_at" => "2024-11-20 17:00:43",
                "updated_at" => "2024-11-20 17:03:28",
            ),
            array(
                "id" => 2,
                "label" => "About Us",
                "link" => "/about",
                "parent_id" => 0,
                "sort" => 1,
                "class" => NULL,
                "menu_id" => 2,
                "depth" => 0,
                "created_at" => "2024-11-20 17:01:59",
                "updated_at" => "2024-11-20 17:07:43",
            ),
            array(
                "id" => 4,
                "label" => "Our Service",
                "link" => "#",
                "parent_id" => 0,
                "sort" => 3,
                "class" => NULL,
                "menu_id" => 2,
                "depth" => 0,
                "created_at" => "2024-11-20 17:03:09",
                "updated_at" => "2024-11-20 17:09:32",
            ),
            array(
                "id" => 5,
                "label" => "Contact Us",
                "link" => "/contact",
                "parent_id" => 0,
                "sort" => 1,
                "class" => NULL,
                "menu_id" => 3,
                "depth" => 0,
                "created_at" => "2024-11-20 17:11:09",
                "updated_at" => "2024-11-20 17:11:09",
            ),
            array(
                "id" => 6,
                "label" => "Setting",
                "link" => "#",
                "parent_id" => 0,
                "sort" => 0,
                "class" => NULL,
                "menu_id" => 4,
                "depth" => 0,
                "created_at" => "2024-11-20 17:14:45",
                "updated_at" => "2024-11-20 17:15:07",
            ),
            array(
                "id" => 7,
                "label" => "Contact",
                "link" => "/contact",
                "parent_id" => 0,
                "sort" => 1,
                "class" => NULL,
                "menu_id" => 4,
                "depth" => 0,
                "created_at" => "2024-11-20 17:15:44",
                "updated_at" => "2024-11-20 17:15:44",
            ),
            array(
                "id" => 8,
                "label" => "Home",
                "link" => "/",
                "parent_id" => 0,
                "sort" => 0,
                "class" => NULL,
                "menu_id" => 1,
                "depth" => 0,
                "created_at" => "2024-11-20 17:24:50",
                "updated_at" => "2024-11-20 17:25:13",
            ),
            array(
                "id" => 9,
                "label" => "About",
                "link" => "/about",
                "parent_id" => 0,
                "sort" => 1,
                "class" => NULL,
                "menu_id" => 1,
                "depth" => 0,
                "created_at" => "2024-11-20 17:25:13",
                "updated_at" => "2024-11-20 17:25:54",
            ),
            array(
                "id" => 10,
                "label" => "Chefs",
                "link" => "/chef",
                "parent_id" => 13,
                "sort" => 5,
                "class" => NULL,
                "menu_id" => 1,
                "depth" => 1,
                "created_at" => "2024-11-20 17:25:55",
                "updated_at" => "2024-11-20 17:34:22",
            ),
            array(
                "id" => 11,
                "label" => "Contact",
                "link" => "/contact",
                "parent_id" => 0,
                "sort" => 2,
                "class" => NULL,
                "menu_id" => 1,
                "depth" => 0,
                "created_at" => "2024-11-20 17:26:11",
                "updated_at" => "2024-11-20 17:34:05",
            ),
            array(
                "id" => 12,
                "label" => "Testimonials",
                "link" => "/testimonials",
                "parent_id" => 13,
                "sort" => 4,
                "class" => NULL,
                "menu_id" => 1,
                "depth" => 1,
                "created_at" => "2024-11-20 17:26:47",
                "updated_at" => "2024-11-20 17:34:05",
            ),
            array(
                "id" => 13,
                "label" => "Pages",
                "link" => "#",
                "parent_id" => 0,
                "sort" => 3,
                "class" => NULL,
                "menu_id" => 1,
                "depth" => 0,
                "created_at" => "2024-11-20 17:27:25",
                "updated_at" => "2024-11-20 17:34:05",
            ),
            array(
                "id" => 14,
                "label" => "Products",
                "link" => "/products",
                "parent_id" => 0,
                "sort" => 1,
                "class" => NULL,
                "menu_id" => 1,
                "depth" => 0,
                "created_at" => "2024-11-20 17:27:25",
                "updated_at" => "2024-11-20 17:34:05",
            ),
        );

        DB::table('admin_menus')->insert($admin_menus);

        DB::table('admin_menu_items')->insert($admin_menu_items);
    }
}
