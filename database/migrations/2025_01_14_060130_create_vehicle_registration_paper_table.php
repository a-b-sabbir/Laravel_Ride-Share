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
        Schema::create('vehicle_registration_paper', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->string('registration_photo');
            $table->string('registration_number')->unique();
            $table->string('vehicle_description');
            $table->string('chassis_no')->unique();
            $table->string('engine_no')->unique();
            $table->float('empty_weight')->nullable();
            $table->float('loaded_weight')->nullable();
            $table->integer('no_of_tyre')->nullable();
            $table->integer('size_length')->nullable();
            $table->integer('size_width')->nullable();
            $table->integer('size_height')->nullable();
            $table->float('front_overhang')->nullable();
            $table->float('rear_overhang')->nullable();
            $table->string('name');
            $table->string('father_or_husband_name')->nullable();
            $table->string('address');
            $table->string('TIN');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('customer_identification')->nullable();
            $table->string('certificate_number')->nullable();
            $table->boolean('is_rented')->nullable();
            $table->integer('seat');
            $table->integer('cylinder')->nullable();
            $table->integer('cc')->nullable();
            $table->string('tyre_size')->nullable();
            $table->string('color');
            $table->string('inspector_name')->nullable();
            $table->string('inspector_designation')->nullable();
            $table->string('inspector_area')->nullable();
            $table->date('inspection_date')->nullable();
            $table->date('approval_date')->nullable();
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
        Schema::dropIfExists('vehicle_registration_paper');
    }
};
