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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('referrer_pilot_id');
            $table->unsignedBigInteger('referred_user_id');
            $table->enum('type', ['Pilot', 'Passenger']);
            $table->timestamp('referral_date')->useCurrent();
            $table->enum('status', ['Pending', 'Successful', 'Failed'])->default('Pending');
            $table->boolean('rewards_given')->default(false);

            $table->timestamps();

            $table->foreign('referrer_pilot_id')->references('id')->on('pilots')->onDelete('cascade');
            $table->foreign('referred_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
