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
        Schema::table('blotters', function (Blueprint $table) {
            $table->foreign(['complainant'])->references(['id'])->on('residents')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['encoder'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blotters', function (Blueprint $table) {
            $table->dropForeign('blotters_complainant_foreign');
            $table->dropForeign('blotters_encoder_foreign');
        });
    }
};
