<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSales1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales1s', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('bill_no');
            $table->string('invoice_no');
            $table->string('sales_date');
            $table->string('sub_total');
            $table->string('cgst');
            $table->string('cgst_amount');
            $table->string('sgst');
            $table->string('sgst_amount');
            $table->string('discount');
            $table->string('grand_total');
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
        Schema::dropIfExists('sales1s');
    }
}
