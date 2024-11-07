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
        Schema::create('brgy_officials', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('punong_barangay', 50);
            $table->string('brgy_councilor1', 50);
            $table->string('brgy_councilor2', 50);
            $table->string('brgy_councilor3', 50);
            $table->string('brgy_councilor4', 50);
            $table->string('brgy_councilor5', 50);
            $table->string('brgy_councilor6', 50);
            $table->string('brgy_councilor7', 50);
            $table->string('sk_councilor', 50);
            $table->string('brgy_secretary', 50);
            $table->string('brgy_treasurer', 50);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brgy_officials');
    }
};
