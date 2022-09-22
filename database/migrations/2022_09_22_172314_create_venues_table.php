<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("mobile");
            $table->string("email");
            $table->string("excerpt");
            $table->string("description");
            $table->string("logo");
            $table->string("cover");
            $table->string("location");
            $table->string("address");
            $table->date("founded_at");
            $table->string("tags");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venues');
    }
}
