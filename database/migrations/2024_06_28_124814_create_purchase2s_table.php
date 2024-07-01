<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchase2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase2s', function (Blueprint $table) {
            $table->id();
            $table->string('bill_no');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('quantity');
            $table->string('unit_price');
            $table->string('cgst');
            $table->string('sgst');
            $table->string('total');
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
        Schema::dropIfExists('purchase2s');
    }
}
