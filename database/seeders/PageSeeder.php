<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageBanner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $pages = [
            'home_blog_section','home_section_1','home_section_2','gallery','blog','contact','about','services','packages','why_us','mission_vision','mission','vision','testimonial','counter','message_from_chairman','lisence_and_certificates','organizational_chart','company_overview','how_it_works','footer','header1','header2','category','vacancies','hire_workers'
      
            // 'required_documents','recruitement_procedure' are 
                //  in  Procedure seeder 
        ];
        foreach($pages as $page){
            Page::updateOrCreate(['title'=>$page,'slug'=>$page]);
        }
    }
}
