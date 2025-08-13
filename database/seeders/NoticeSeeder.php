<?php

namespace Database\Seeders;

use App\Models\Notice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notice::updateOrCreate([
            'title' =>"Testing Roshan",
            "description"=>"testing",
            // "image"=>"/uploads/image.png"
             "url"=>"http://127.0.0.1:8000/"

        ]);
        //
    }
}
