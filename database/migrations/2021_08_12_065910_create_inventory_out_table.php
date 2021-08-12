<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_out', function (Blueprint $table) {
            $table->id('inventory_out_id');
            $table->foreignId('inventory_id')->references('inventory_id')->on('inventory');
            $table->integer('qty');
            $table->foreignId('transaction_id')->references('transaction_id')->on('transactions');
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
        Schema::dropIfExists('inventory_out');
    }
}
