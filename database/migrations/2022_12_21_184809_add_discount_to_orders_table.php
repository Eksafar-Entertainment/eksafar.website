<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer("discount")->default(0);
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->integer("discount")->default(0);
            $table->string("coupon")->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn("discount");
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn("discount");
            $table->dropColumn("coupon");
        });
    }
}
