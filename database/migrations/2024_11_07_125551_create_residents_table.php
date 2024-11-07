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
        Schema::dropIfExists('residents');
        Schema::create('residents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('salutation')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('additional_name')->nullable();
            $table->string('nationality')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_voter')->default(false);
            $table->boolean('is_HW')->default(false);
            $table->tinyInteger('is_PWD')->default(0);
            $table->string('disability', 100)->nullable();
            $table->boolean('is_deceased')->default(false);
            $table->string('death_reason')->nullable();
            $table->date('date_of_death')->nullable();
            $table->integer('age');
            $table->date('birthdate');
            $table->string('birthplace')->nullable();
            $table->date('period_of_stay')->nullable();
            $table->string('gender');
            $table->double('height_ft')->nullable();
            $table->double('weight_kg')->nullable();
            $table->string('marital_status');
            $table->string('unique_identity')->nullable();
            $table->string('house_number')->nullable();
            $table->string('building')->nullable();
            $table->string('street');
            $table->string('other_location')->nullable();
            $table->string('profile_pic')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('added_by')->index('residents_added_by_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
