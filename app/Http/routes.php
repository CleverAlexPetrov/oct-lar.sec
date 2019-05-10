<?php
use Illuminate\Http\Request;
use App\Task;
Route::get('/', function () {
    $tasks = Task::all();
    return view('tasks.index', [
        'tasks' => $tasks,
            //значение переменной tasks спроэцируется в переменнную tasks внутри папки view
    ]); //в ларавель это tasks
});
Route::post('/tasks', function(Request $request) {
    $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
    ]);
    if ($validator->fails()) {
        return redirect('/')
                        ->withInput()
                        ->withErrors($validator);
    }
    $task = new App\Task();
    $task->name = $request->name;
    $task->save();
    return redirect('/');
});
Route::delete('/tasks/{task}', function(Task $task) {
    $task->delete();
    return redirect('/');
});
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('tasks.edit', [
	'task' => $task,
    ]);
});
Route::put('/tasks/{task}',function(Request $request, Task $task){ 
    $validator = Validator::make($request->all(), [
		'name' => 'required|max:255',
    ]);
    if ($validator->fails()) {
	return redirect('/')
			->withInput()
			->withErrors($validator);
    }
    $task->name = $request->name;
    $task->save();
    return redirect('/');
});