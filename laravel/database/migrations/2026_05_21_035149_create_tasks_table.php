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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // description -> текст
            $table->text('description');
            $table->enum('status', ['pending', 'in_progress', 'done'])->default('pending');
            // status -> выбор из готовых вариантов (pending, in_progress, done)
            // станлартное значение 'pending'
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            // priority -> выбор из готовых вариантов (low, medium, high)
            // станлартное значение 'medium'
            // due_date -> дата, значение может отсутствовать 
            $table->date('due_date')->nullable();
            // user_id -> айдишка юзера, привязанная к другой таблице,
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // задача удаляется при удалении юзера
            // category_id -> айдишка юзера, привязанная к другой таблице, может отсутсвовать
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            // категория обнуляется при удалении юзера
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
