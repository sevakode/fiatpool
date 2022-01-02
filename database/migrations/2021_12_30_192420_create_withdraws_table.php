<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->float('eth')->nullable();
            $table->float('eth_usd')->nullable();
            $table->float('toncoin')->nullable();
            $table->float('toncoin_usd')->nullable();
            $table->float('payout')->nullable();
            $table->float('profits')->nullable();
            $table->integer('miner_id');
            $table->dateTime('completed_at')->nullable();
            $table->boolean('status')->default(false);

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
        Schema::dropIfExists('withdraws');
    }
}
