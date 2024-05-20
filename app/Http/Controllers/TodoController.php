<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::latest()->get();
        return view('todos.index', compact('todos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Todo::create([
            'title' => $request->title,
        ]);

        return redirect()->route('todos.index');
    }

    public function update(Request $request, Todo $todo)
    {
        $todo->update([
            'completed' => $request->completed,
        ]);

        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index');
    }




}
