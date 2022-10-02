<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventComboTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_combo_tickets', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("price");
            $table->integer("event_id");
            $table->json("event_tickets");
            $table->string("status")->nullable()->default("CREATED");
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
        Schema::dropIfExists('event_combo_tickets');
    }
}
