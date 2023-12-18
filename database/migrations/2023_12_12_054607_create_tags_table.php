<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('color', ['red', 'blue', 'green', 'yellow', 'purple', 'indigo', 'pink', 'gray'])->default('gray');
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->unique(['name', 'project_id']);
            // not sure if it's necessary to have this unique constraint
            $table->unique(['id', 'project_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
