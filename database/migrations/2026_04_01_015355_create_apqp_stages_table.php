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
        Schema::create('m_apqp_stages', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name', 255);
            $table->string('status')->default('open');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('m_stage_dependencies', function (Blueprint $table) {
            // ID tahapan yang mau dikerjakan (Contoh: Management Support)
            $table->foreignId('stage_id')->constrained('m_apqp_stages')->cascadeOnDelete();

            // ID tahapan yang WAJIB SELESAI lebih dulu (Contoh: Market Research, dll)
            $table->foreignId('prerequisite_id')->constrained('m_apqp_stages')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(['m_apqp_stages', 'm_stage_dependencies']);
    }
};
