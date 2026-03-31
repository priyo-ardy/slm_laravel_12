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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->after('email')->nullable();
            $table->string('image')->nullable();
            $table->integer('login_attempts')->default(0);
            $table->boolean('is_locked')->default(false);
            $table->dateTimeTz('last_login')->nullable();
            $table->string('login_from', 20)->nullable();
            $table->text('remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'image', 'login_attempts', 'is_locked', 'last_login', 'login_from', 'remark']);
        });
    }
};
