<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_gateway_settings = array(
            array(
                "id" => 1,
                "key" => "stripe_logo",
                "value" => "/uploads/media_67301fb7d0a23.png",
                "created_at" => "2024-11-10 02:51:35",
                "updated_at" => "2024-11-10 02:51:35",
            ),
            array(
                "id" => 2,
                "key" => "stripe_status",
                "value" => "1",
                "created_at" => "2024-11-10 02:51:35",
                "updated_at" => "2024-11-10 11:16:13",
            ),
            array(
                "id" => 3,
                "key" => "stripe_country",
                "value" => "MY",
                "created_at" => "2024-11-10 02:51:35",
                "updated_at" => "2024-11-10 02:51:35",
            ),
            array(
                "id" => 4,
                "key" => "stripe_currency",
                "value" => "MYR",
                "created_at" => "2024-11-10 02:51:35",
                "updated_at" => "2024-11-10 02:51:35",
            ),
            array(
                "id" => 5,
                "key" => "stripe_rate",
                "value" => "1",
                "created_at" => "2024-11-10 02:51:35",
                "updated_at" => "2024-11-10 02:51:35",
            ),
            array(
                "id" => 6,
                "key" => "stripe_api_key",
                "value" => "pk_test_51QJQabKzSwxaAKVmzNlfEbbsXG4OuxVzVhOR4FnF5c9UVAFxUhkzurC1u6sMmCEA52I7Lqx69fUYNzQpLjZzS0U800dgdO4Ijx",
                "created_at" => "2024-11-10 02:51:35",
                "updated_at" => "2024-11-10 02:51:35",
            ),
            array(
                "id" => 7,
                "key" => "stripe_secret_key",
                "value" => "sk_test_51QJQabKzSwxaAKVmwXUxj5nnGf91isMyu6lmdGSD9vBF1RFiRD1riBycHWCVRbpaA3ejhkM2OpRmeGMJNmhKsDL400lURkGr8K",
                "created_at" => "2024-11-10 02:51:35",
                "updated_at" => "2024-11-10 02:51:35",
            ),
        );

        \DB::table('payment_gateway_settings')->insert($payment_gateway_settings);
    }
}
