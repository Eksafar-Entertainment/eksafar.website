<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            $table->enum("type", ["SMS", "MAIL", "WHATSAPP"]);
        
            $table->enum("content_type", ["TEMPLATE", "HTML", "TEXT"]);

            $table->string("content");
            $table->string("status")->default("CREATED"); // CREATED | PENDING | ACTIVE | COMPLETED

        });

        Schema::create('campaign_receipts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            
            $table->string("status")->default("PENDING"); // CREATED | PENDING | SENT | FAILED

            $table->dateTime("send_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
        Schema::dropIfExists('campaign_receipts');
    }
}
