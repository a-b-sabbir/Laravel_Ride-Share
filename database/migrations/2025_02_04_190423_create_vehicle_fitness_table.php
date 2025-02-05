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
        Schema::create('vehicle_fitness', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->string('fitness_photo');
            $table->unsignedBigInteger('vehicle_identity_no');
            $table->unsignedBigInteger('user_identity_no');
            $table->string('registration_no')->unique();
            $table->string('certificate_no')->unique();
            $table->string('vehicle_description');
            $table->string('chassis_no')->unique();
            $table->string('engine_no')->unique();
            $table->boolean('hired')->default(true);
            $table->integer('seats');
            $table->integer('cylinder');
            $table->integer('cc');
            $table->integer('unladen_weight');
            $table->integer('laden_weight');
            $table->string('color');
            $table->integer('number_of_tyres')->default(4);
            $table->string('size_of_tyre');
            $table->integer('dimension_length');
            $table->integer('dimension_width');
            $table->integer('dimension_height');
            $table->string('front_overhang');
            $table->string('back_overhang');
            $table->string('name');
            $table->string('husband_or_father_name');
            $table->text('address');
            $table->integer('TIN');
            $table->date('issue_date');
            $table->date('fitness_period_start');
            $table->date('fitness_period_end');
            $table->string('inspector_name');
            $table->string('inspector_designation');
            $table->string('inspector_area');
            $table->date('inspection_date');

            $table->timestamps();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_fitness');
    }
};
