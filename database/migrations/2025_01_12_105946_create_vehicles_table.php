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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Car', 'Bike']);
            $table->enum('category', ['Regular', 'Premium'])->default('Regular');
            $table->string('photo')->nullable();
            $table->string('vehicle_number')->unique();
            $table->string('brand');
            $table->integer('make');
            $table->string('model');
            $table->string('color');
            $table->enum('approval', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
