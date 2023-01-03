<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sele_reciepts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sele_id');
            $table->tinyInteger('pyment_type');
            $table->float('pyment_amount');
            $table->string('bank_name' , 50);
            $table->string('bank_account_number' , 50);
            $table->string('chack_number' , 50);
            $table->string('transfered_to', 50);
            $table->string('reciept_code' , 30);
            $table->unsignedBigInteger('user_id');
            $table->foreign('sele_id')->references('id')->on('seles')->onDelete('cascade');
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
        Schema::dropIfExists('sele_reciepts');
    }
};
