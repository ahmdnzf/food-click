<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = array(
            array(
                "id" => 1,
                "key" => "site_name",
                "value" => "Food Click",
                "created_at" => "2024-10-28 13:26:36",
                "updated_at" => "2024-11-08 12:07:22",
            ),
            array(
                "id" => 2,
                "key" => "site_default_currency",
                "value" => "MYR",
                "created_at" => "2024-10-28 13:26:36",
                "updated_at" => "2024-10-28 14:46:19",
            ),
            array(
                "id" => 3,
                "key" => "site_currency_icon",
                "value" => "RM",
                "created_at" => "2024-10-28 13:26:36",
                "updated_at" => "2024-11-08 12:07:46",
            ),
            array(
                "id" => 4,
                "key" => "site_currency_icon_position",
                "value" => "left",
                "created_at" => "2024-10-28 13:26:36",
                "updated_at" => "2024-10-28 15:23:05",
            ),
            array(
                "id" => 5,
                "key" => "pusher_app_id",
                "value" => "1892887",
                "created_at" => "2024-11-08 12:06:09",
                "updated_at" => "2024-11-08 12:06:09",
            ),
            array(
                "id" => 6,
                "key" => "pusher_key",
                "value" => "de068e85618452924172",
                "created_at" => "2024-11-08 12:06:09",
                "updated_at" => "2024-11-08 12:06:09",
            ),
            array(
                "id" => 7,
                "key" => "pusher_secret",
                "value" => "ef7da5a40437328bc550",
                "created_at" => "2024-11-08 12:06:09",
                "updated_at" => "2024-11-08 12:06:09",
            ),
            array(
                "id" => 8,
                "key" => "pusher_cluster",
                "value" => "ap1",
                "created_at" => "2024-11-08 12:06:09",
                "updated_at" => "2024-11-15 17:15:19",
            ),
            array(
                "id" => 9,
                "key" => "mail_driver",
                "value" => "smtp",
                "created_at" => "2024-11-19 13:04:19",
                "updated_at" => "2024-11-19 13:16:32",
            ),
            array(
                "id" => 10,
                "key" => "mail_host",
                "value" => "sandbox.smtp.mailtrap.io",
                "created_at" => "2024-11-19 13:04:19",
                "updated_at" => "2024-11-19 13:16:32",
            ),
            array(
                "id" => 11,
                "key" => "mail_port",
                "value" => "2525",
                "created_at" => "2024-11-19 13:04:19",
                "updated_at" => "2024-11-19 13:16:32",
            ),
            array(
                "id" => 12,
                "key" => "mail_username",
                "value" => "cab3e4f056635f",
                "created_at" => "2024-11-19 13:04:19",
                "updated_at" => "2024-11-19 13:16:32",
            ),
            array(
                "id" => 13,
                "key" => "mail_password",
                "value" => "d8a0729fb848ac",
                "created_at" => "2024-11-19 13:04:19",
                "updated_at" => "2024-11-19 13:16:32",
            ),
            array(
                "id" => 14,
                "key" => "mail_encryption",
                "value" => "tls",
                "created_at" => "2024-11-19 13:04:19",
                "updated_at" => "2024-11-19 13:16:32",
            ),
            array(
                "id" => 15,
                "key" => "mail_from_address",
                "value" => "food-click@example.com",
                "created_at" => "2024-11-19 13:04:19",
                "updated_at" => "2024-11-19 13:16:32",
            ),
            array(
                "id" => 16,
                "key" => "mail_receive_address",
                "value" => "support.food-click@example.com",
                "created_at" => "2024-11-19 13:04:19",
                "updated_at" => "2024-11-19 13:16:32",
            ),
            array(
                "id" => 21,
                "key" => "logo",
                "value" => "/uploads/media_67443c4a29c4f.png",
                "created_at" => "2024-11-25 04:53:28",
                "updated_at" => "2024-11-25 08:58:50",
            ),
            array(
                "id" => 22,
                "key" => "footer_logo",
                "value" => "/uploads/media_67443c4a30df0.png",
                "created_at" => "2024-11-25 04:55:29",
                "updated_at" => "2024-11-25 08:58:50",
            ),
            array(
                "id" => 23,
                "key" => "favicon",
                "value" => "/uploads/media_67443c4a32ce0.jpeg",
                "created_at" => "2024-11-25 04:55:29",
                "updated_at" => "2024-11-25 08:58:50",
            ),
            array(
                "id" => 24,
                "key" => "breadcrumb",
                "value" => "/uploads/media_6744406624fcf.png",
                "created_at" => "2024-11-25 04:55:29",
                "updated_at" => "2024-11-25 09:16:22",
            ),
            array(
                "id" => 25,
                "key" => "site_email",
                "value" => "food-click@gmail.com",
                "created_at" => "2024-11-25 09:21:56",
                "updated_at" => "2024-11-25 09:21:56",
            ),
            array(
                "id" => 26,
                "key" => "site_phone",
                "value" => "012-774284",
                "created_at" => "2024-11-25 09:21:56",
                "updated_at" => "2024-11-25 09:24:13",
            ),
            array(
                "id" => 27,
                "key" => "site_color",
                "value" => "#a7c0ef",
                "created_at" => "2024-11-25 09:42:24",
                "updated_at" => "2024-11-25 12:18:36",
            ),
            array(
                "id" => 28,
                "key" => "seo_title",
                "value" => "Food Click",
                "created_at" => "2024-11-25 09:53:40",
                "updated_at" => "2024-11-25 09:53:40",
            ),
            array(
                "id" => 29,
                "key" => "seo_description",
                "value" => "Test Description",
                "created_at" => "2024-11-25 09:53:40",
                "updated_at" => "2024-11-25 09:53:40",
            ),
            array(
                "id" => 30,
                "key" => "seo_keywords",
                "value" => "food,restaurant",
                "created_at" => "2024-11-25 09:53:40",
                "updated_at" => "2024-11-25 09:53:50",
            ),
        );


        \DB::table('settings')->insert($settings);
    }
}
