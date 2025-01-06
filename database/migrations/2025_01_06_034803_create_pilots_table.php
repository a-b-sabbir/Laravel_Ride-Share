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
        Schema::create('pilots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nid');
            $table->string('nid_image');
            $table->text('address');
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->string('relation_with_emergency_contact')->nullable();
            $table->enum('preferred_shift', ['Day', 'Night', 'Flexible'])->default('Flexible');
            $table->enum('preferred_vehicle_type', ['Car', 'Bike'])->default('Car')->index();
            $table->float('rating')->default(0);
            $table->integer('no_of_rides')->default(0);
            $table->integer('no_of_complaints')->default(0);
            $table->float('positive_feedback_percentage')->default(0);
            $table->enum('account_status', ['Active', 'Suspended', 'Deactivated'])->default('Active');
            $table->enum('availability_status', ['Available', 'On Trip', 'Offline'])->default('Offline')->index();
            $table->enum('background_check_status', ['Pending', 'Passed', 'Failed'])->default('Pending');
            $table->boolean('training_completed')->default(false);
            $table->enum('payment_method', ['Mobile Payment', 'Cash'])->default('Mobile Payment');
            $table->decimal('wallet_balance')->default(0);
            $table->float('total_distance_driven')->default(0);
            $table->timestamp('last_trip_completed_at')->nullable();
            $table->boolean('owns_vehicle')->default(false);
            $table->string('ownership_document')->nullable();
            $table->string('background_check_document')->nullable();
            $table->decimal('current_latitude', 10, 8)->nullable();
            $table->decimal('current_longitude', 11, 8)->nullable();
            $table->timestamp('last_active_at')->nullable();
            $table->date('employment_start_date')->nullable();
            $table->date('employment_end_date')->nullable();
            $table->boolean('contract_signed')->default(false);
            $table->boolean('approval')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilots');
    }
};
