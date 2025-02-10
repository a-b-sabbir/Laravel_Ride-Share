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
        Schema::table('pilots', function (Blueprint $table) {
            $table->date('last_payment_date')->nullable();
            $table->date('payment_due_date')->nullable();
            $table->double('paid_amount')->default(0);
            $table->date('approval_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pilots', function (Blueprint $table) {
            $table->dropColumn('last_payment_date');
            $table->dropColumn('payment_due_date');
            $table->dropColumn('paid_amount');
            $table->dropColumn('approval_date');
        });
    }
};
