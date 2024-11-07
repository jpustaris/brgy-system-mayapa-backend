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
        Schema::dropIfExists('certificates');
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('certificate_type_id')->default('1');
            $table->foreign('certificate_type_id')->references('id')->on('certificate_types')->onDelete('cascade');
            $table->unsignedBigInteger('created_by_user_id')->default('1');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->string('certificate_issued_to')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('certificates');
    }
};
