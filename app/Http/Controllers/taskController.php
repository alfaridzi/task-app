<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests;
use Validator;
class taskController extends Controller
{
    public function index() {
    	$tasks = Task::where('status',0)->orderBy('created_at', 'asc')->get();
    	return view('tasks', compact('tasks'));
    }
    public function finishTask() {
    	$tasks = Task::where('status',1)->orderBy('updated_at', 'desc')->get();
    	return view('task-finish', compact('tasks'));
    }
    public function updateTask($id) {
    	Task::findOrFail($id)->update(['name' => request()->get('name')]);
        return redirect()->back();
    }
    public function addTask(Request $request) {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
        $task = task::create(['name' => $request->name]);
        return redirect()->back();
    }
    public function deleteTask($id) {
    	 Task::findOrFail($id)->delete();
         return redirect()->back();
    }
    public function updateTofinishedTask($id) {
    	Task::findOrFail($id)->update(['status' => 1]);
        return redirect()->back();
    }
}
