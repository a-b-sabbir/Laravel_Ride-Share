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
        Schema::create('pilot_licenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pilot_id');
            $table->enum('type', ['Professional', 'Non-Professional']);
            $table->string('name');
            $table->string('address');
            $table->date('birth_date');
            $table->string('blood_group', 4)->nullable();
            $table->string('father_or_husband_name');
            $table->string('license_photo');
            $table->string('license_number')->unique();
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->unsignedBigInteger('ref_no')->nullable();
            $table->string('issuing_authority');
            $table->boolean('approval')->default(false);

            $table->timestamps();

            $table->foreign('pilot_id')->references('id')->on('pilots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilot_licenses');
    }
};
