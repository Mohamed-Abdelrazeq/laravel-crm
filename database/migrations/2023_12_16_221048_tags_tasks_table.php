<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tags_tasks', function (Blueprint $table) {
            $table->foreignId('tag_id')->constrained();
            $table->foreignId('task_id')->constrained();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->primary(['tag_id', 'task_id', 'project_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tags_tasks');
    }
};
