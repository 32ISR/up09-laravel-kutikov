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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // title -> строка
            // description -> текст
            // status -> выбор из готовых вариантов (pending, in_progress, done)
            // станлартное значение 'pending'
            // priority -> выбор из готовых вариантов (low, medium, high)
            // станлартное значение 'medium'
            // due_date -> дата, значение может отсутствовать 
            // user_id -> айдишка юзера, привязанная к другой таблице,
            // задача удаляется при удалении юзера
            // category_id -> айдишка юзера, привязанная к другой таблице, может отсутсвовать
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
