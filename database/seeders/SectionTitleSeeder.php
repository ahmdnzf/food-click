<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section_titles = array(
            array(
                "id" => 1,
                "key" => "chef_top_title",
                "value" => "Our Best Chef",
                "created_at" => "2024-11-04 18:59:23",
                "updated_at" => "2024-11-04 19:05:31",
            ),
            array(
                "id" => 2,
                "key" => "chef_main_title",
                "value" => "Meet Our Expert Chefs",
                "created_at" => "2024-11-04 18:59:23",
                "updated_at" => "2024-11-04 19:05:31",
            ),
            array(
                "id" => 3,
                "key" => "chef_sub_title",
                "value" => "Objectively Pontificate Quality Models Before Intuitive Information.",
                "created_at" => "2024-11-04 18:59:23",
                "updated_at" => "2024-11-04 19:05:31",
            ),
            array(
                "id" => 4,
                "key" => "testimonial_top_title",
                "value" => "Testimonial",
                "created_at" => "2024-11-04 19:09:11",
                "updated_at" => "2024-11-08 10:20:12",
            ),
            array(
                "id" => 5,
                "key" => "testimonial_main_title",
                "value" => "Our Customer Feedbacks",
                "created_at" => "2024-11-04 19:09:11",
                "updated_at" => "2024-11-08 10:20:12",
            ),
            array(
                "id" => 6,
                "key" => "testimonial_sub_title",
                "value" => "Magnam aut rem accus",
                "created_at" => "2024-11-04 19:09:47",
                "updated_at" => "2024-11-04 19:09:47",
            ),
        );


        \DB::table('section_titles')->insert($section_titles);

    }
}
