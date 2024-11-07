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
        Schema::dropIfExists('residents');
        Schema::create('residents', function (Blueprint $table) {
            $table->id();

            $table->string('salutation')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('additional_name')->nullable();
            $table->string('nationality')->nullable();

            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_voter')->default('0');
            $table->boolean('is_HW')->default('0');
            $table->boolean('is_PWD')->default('0');
            $table->boolean('is_deceased')->default('0');

            $table->integer('age');
            $table->date('birthdate');
            $table->string('gender');
            $table->double('height_ft')->nullable();
            $table->double('weight_kg')->nullable();
            
            $table->string('marital_status');
            $table->string('unique_identity')->nullable();

            $table->string('house_number')->nullable();
            $table->string('building')->nullable();
            $table->string('street');
            $table->string('other_location')->nullable();

            $table->text('note')->nullable();
            

            $table->unsignedBigInteger('added_by');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('residents');
    }
};
