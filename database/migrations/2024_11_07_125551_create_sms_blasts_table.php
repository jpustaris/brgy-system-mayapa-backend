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
        Schema::dropIfExists('sms_blasts');
        Schema::create('sms_blasts', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('member_ids');
            $table->string('member_numbers');
            $table->string('message_content');
            $table->bigInteger('created_by_user_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('update_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_blasts');
    }
};
