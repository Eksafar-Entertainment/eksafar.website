<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_schedules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("to");
            $table->string("name");
            $table->string("subject");
            $table->longText("html");
            $table->longText("text");
            $table->string("status")->default("CREATED");
            $table->integer("priority")->default(0);
            $table->dateTime("send_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_schedules');
    }
}
