<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('login_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_user_id')->nullable();
            $table->string('username');
            $table->string('ip_address');
            $table->string('user_agent')->nullable();
            $table->enum('status', ['success', 'failed']);
            $table->string('failure_reason')->nullable();
            $table->timestamp('login_at');
            $table->timestamps();
            $table->foreign('admin_user_id')->references('id')->on('admin_users')->onDelete('set null');
            $table->index(['username', 'login_at']);
            $table->index(['ip_address', 'login_at']);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('login_logs');
    }
};