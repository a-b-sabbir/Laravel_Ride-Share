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
        Schema::create('vehicle_tax_token', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id')->index();
            $table->string('tax_token_photo');
            $table->date('print_date');
            $table->string('registration_number');
            $table->date('registration_date');
            $table->string('tax_token_number')->unique();
            $table->string('transaction_number')->unique();
            $table->string('eTracking_no')->nullable();
            $table->string('issuing_bank_name');
            $table->string('issuing_branch');
            $table->string('issuing_teller_name');
            $table->string('chassis_number');
            $table->string('engine_number');
            $table->integer('seats');
            $table->float('laden_weight');
            $table->string('owner_name');
            $table->string('father_or_husband_name');
            $table->date('previous_expiry_date');
            $table->date('issue_date');
            $table->date('tax_period_start');
            $table->date('tax_period_end');
            $table->double('principal_amount');
            $table->double('fine')->default(0);
            $table->double('total_amount');
            $table->timestamps();

            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_tax_token');
    }
};
