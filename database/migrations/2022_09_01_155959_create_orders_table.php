<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile');
            $table->string('email');
            $table->string('event_id');
            $table->string('payment_id');
            $table->integer('total_price');
            $table->string('status');
            $table->boolean('is_checked_in')->nullable();
            $table->integer("promoter_id")->nullable()->reference("id")->on("promoters");
            $table->timestamps();
        });

        DB::update("ALTER TABLE orders AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
