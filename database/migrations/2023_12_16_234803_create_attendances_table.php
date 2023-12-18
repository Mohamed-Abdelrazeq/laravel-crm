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
        Schema::create('attendances', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('project_id')->constrained();
            $table->timestamp('clock_in')->default(now());
            $table->timestamp('clock_out')->nullable();
            $table->timestamps();
            $table->primary(['user_id', 'project_id', 'clock_in']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
