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
        Schema::create('tags_tasks', function (Blueprint $table) {
            $table->foreignId('tag_id')->constrained();
            $table->foreignId('task_id')->constrained();
            $table->primary(['tag_id', 'task_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags_tasks');
    }
};
