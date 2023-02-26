<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPromotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promoters', function (Blueprint $table) {
            //
            $table->integer("parent_id")->nullable();
            $table->string("email")->nullable();
            $table->string("mobile")->nullable();
            $table->string("password")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promoters', function (Blueprint $table) {
            //
        });
    }
}
