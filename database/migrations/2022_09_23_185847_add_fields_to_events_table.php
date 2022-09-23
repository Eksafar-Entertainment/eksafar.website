<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('artist');
            $table->json("artists");
            $table->string("terms");
            $table->string("min_age");
            $table->string("language");
            $table->string("banners");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn("artists");
            $table->dropColumn("terms");
            $table->dropColumn("min_age");
            $table->dropColumn("language");
            $table->dropColumn("banners");
        });
    }
}
