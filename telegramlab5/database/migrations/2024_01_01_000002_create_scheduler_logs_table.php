<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('scheduler_logs')) {
            Schema::create('scheduler_logs', function (Blueprint $table) {
                $table->id();
                $table->string('command_name');
                $table->string('status'); 
                $table->text('message')->nullable();
                $table->timestamp('executed_at');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('scheduler_logs');
    }
};