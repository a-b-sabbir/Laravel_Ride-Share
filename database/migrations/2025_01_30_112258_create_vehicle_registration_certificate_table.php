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
        Schema::create('vehicle_registration_certificate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->string('registration_photo');
            $table->string('registration_number')->unique();
            $table->date('date');
            $table->string('vehicle_description');
            $table->string('vehicle_class');
            $table->string('color');
            $table->float('cc');
            $table->string('fuel')->nullable();
            $table->integer('seat');
            $table->string('engine_no')->unique();
            $table->string('chassis_no')->unique();
            $table->boolean('hire');
            $table->integer('wheelbase')->nullable();
            $table->float('unladen_weight')->nullable();
            $table->float('laden_weight')->nullable();
            $table->string('issuing_authority');
            $table->boolean('approval')->default(false);
            $table->timestamps();

            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_registration_certificate');
    }
};
