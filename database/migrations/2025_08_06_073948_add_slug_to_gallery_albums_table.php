<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToGalleryAlbumsTable extends Migration
{
    public function up()
    {
        Schema::table('gallery_albums', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
        });
    }

    public function down()
    {
        Schema::table('gallery_albums', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
