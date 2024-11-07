<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('blotters');
        Schema::create('blotters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('complainant')->index('blotters_complainant_foreign');
            $table->string('defendant');
            $table->string('brgy_case_no');
            $table->text('complaint');
            $table->unsignedBigInteger('encoder')->index('blotters_encoder_foreign');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blotters');
    }
};
