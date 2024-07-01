<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSales2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales2s', function (Blueprint $table) {
            $table->id();
            $table->string('bill_no');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('quantity');
            $table->string('unit_price');
            $table->string('total');
            $table->string('sales_type');
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
        Schema::dropIfExists('sales2s');
    }
}
