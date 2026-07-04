<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('password');
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
            $table->string('vallet_password')->nullable();
            $table->string('reference_code')->nullable();
            $table->foreignId('membership_level_id')->nullable();
            $table->foreignId('parent_id')->nullable();
            $table->integer('credibility')->default(0);
            $table->string('status')->default('active');
            $table->string('wallet_status')->default('active');
            $table->string('user_type')->default('user');
            $table->decimal('min_withdraw', 15, 2)->default(0);
            $table->decimal('max_withdraw', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
