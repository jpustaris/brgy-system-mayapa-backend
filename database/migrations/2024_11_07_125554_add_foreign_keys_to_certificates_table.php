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
        Schema::table('certificates', function (Blueprint $table) {
            $table->foreign(['certificate_type_id'])->references(['id'])->on('certificate_types')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['created_by_user_id'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropForeign('certificates_certificate_type_id_foreign');
            $table->dropForeign('certificates_created_by_user_id_foreign');
        });
    }
};
