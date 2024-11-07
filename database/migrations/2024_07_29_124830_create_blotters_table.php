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
        Schema::dropIfExists('blotters');
        Schema::create('blotters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('complainant'); //nagrereklamo 
            $table->foreign('complainant')->references('id')->on('residents')->onDelete('cascade');
            $table->string('defendant'); //inirereklamo
            $table->string('brgy_case_number');
            $table->text('complaint');
            $table->unsignedBigInteger('encoder');
            $table->foreign('encoder')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('is_deleted')->default('0');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('blotters');
    }
};
