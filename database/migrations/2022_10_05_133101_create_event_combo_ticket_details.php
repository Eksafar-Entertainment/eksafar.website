<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventComboTicketDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_combo_ticket_details', function (Blueprint $table) {
            $table->id();
            $table->integer("event_combo_ticket_id");
            $table->integer("event_ticket_id");
            $table->integer("quantity");
            $table->timestamps();
        });

        Schema::create('order_detail_tickets', function (Blueprint $table) {
            $table->id();
            $table->integer("order_detail_id");
            $table->integer("event_ticket_id")->nullable();
            $table->integer("event_combo_ticket_id")->nullable();
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
        Schema::dropIfExists('event_combo_ticket_details');
        Schema::dropIfExists('order_detail_tickets');
    }
}
