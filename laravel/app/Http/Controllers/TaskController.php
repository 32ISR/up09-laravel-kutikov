<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $tasks = $user
            ->tasks()
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'string|required|max:255',
            'description' => 'string|nullable',
            'status' => 'string|in:pending,in_progress,done|required',
            'priority' => 'string|required|in:low,medium,high',
            'due_date' => 'date|nullable|after_or_equal:today',
            'category_id' => 'nullable|exists:categories:id'
        ]);

        $user = Auth::user();
        $user->tasks()->create($data);
        return redirect()->route('tasks.index')->with('success', 'Задача создана');
        // валидируйте
        // title - обязательное, строка, максимум 255 символов
        // description - необязательное, строка
        // status - обязательное, присутствует в enum 'pending','in_progress', 'done
        // 'string|in:pending,in_progress,...'
        // priority - обязательное, присутствует в enum 'low, medium, high'
        // due_date - необязательное, дата, допустимое значение - сегодня и позже
        // after_or_equal:today
        // category_id - необязательное, существует id в таблице категорий
    }

    public function create()
    {
        $user = Auth::user();
        $categories = $user->categories()->get();
        return view('tasks.create', compact('categories'));
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
