<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_transactions', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->bigInteger('user_id')->unsigned();
            $table->string('transid')->nullable();
            $table->string('telcode')->nullable();
            $table->string('code')->nullable();
            $table->string('serial')->nullable();            
            $table->integer('price')->unsigned();           
            $table->float('amount')->unsigned()->default(0);
            $table->integer('status')->default(0);
            $table->string('message')->nullable();
            $table->string('donate_message')->nullable(); 
            $table->string('donate_name')->nullable(); 
            $table->bigInteger('streamer_id')->references('id')->on('streamer_infos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('history_transactions');
    }
}
