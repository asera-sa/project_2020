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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->boolean('is_active')->default(true);
            $table->date('issued_at')->nullable();     // تاريخ إصدار الترخيص
            $table->date('expires_at')->nullable();    // تاريخ انتهاء الترخيص
            $table->text('notes')->nullable();         // ملاحظات إضافية (اختياري)
            $table->foreignId('license_request_id')->constrained('license_requests')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
