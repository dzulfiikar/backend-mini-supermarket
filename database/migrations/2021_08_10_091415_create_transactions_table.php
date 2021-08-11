<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('member_id')->nullable(true)->references('member_id')->on('members');
            $table->foreignId('voucher_id')->nullable(true)->references('voucher_id')->on('vouchers');
            $table->bigInteger('total_price');
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
        Schema::dropIfExists('transactions');
    }
}
