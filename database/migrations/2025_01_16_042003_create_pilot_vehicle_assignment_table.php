<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pilot_vehicle_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pilot_id')->index();
            $table->unsignedBigInteger('vehicle_id')->index();
            $table->timestamp('start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_date')->nullable();
            $table->enum('status', ['Active', 'Suspended', 'Deactivated'])->default('Active');
            $table->string('assignment_notes')->nullable();
            $table->timestamps();

            $table->foreign('pilot_id')->references('id')->on('pilots')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilot_vehicle_assignment');
    }
};
