<?php

use Illuminate\Http\Request;
use App\Task;
use App\News;

Route::get('/', function() {
    return view('index');
})->name('home');

//Route::get('/', function() {
//    return view('news.index');
//})->name('home');

Route::get('/news', function() {
    $news = News::all();
    return view('news.index', [
        'news' => $news,
    ]);
});

Route::get('/{news}/create', function () {
    return view('news.create');
});

Route::post('/news/create', function(Request $request) {
    $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'text' => 'required',
    ]);
    if ($validator->fails()) {
        return redirect('news/create')
                        ->withInput()
                        ->withErrors($validator);
    }
    $news = new App\News;
    $news->name = $request->name;
    $news->text = $request->text;
    $news->save();
    return redirect('/news');
});



Route::get('news/{news}/show', function (News $news) {
    return view('news.show', [
        'news' => $news,
    ]);
});



Route::delete('/news/{news}', function(News $news) {
    $news->delete();
    return redirect('/news');
});

Route::get('/news/{news}/edit', function (News $news) {
    return view('news.edit', [
        'news' => $news,
    ]);
});

Route::put('/news/{news}', function(Request $request, News $news) {
    $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'text' => 'required',
    ]);
    if ($validator->fails()) {
        return redirect('/news/' . $news->id . '/edit')
                        ->withInput()
                        ->withErrors($validator);
    }
    $news->name = $request->name;
    $news->text = $request->text;
    $news->save();
    return redirect('/news');
});

Route::group(['prefix' => 'tasks'], function() {
    Route::get('/', function () {
        $tasks = Task::all();
        return view('tasks.index', [
            'tasks' => $tasks,
                //значение переменной tasks спроэцируется в переменнную tasks внутри папки view
        ]); //в ларавель это tasks
    })->name('tasks_index');

    Route::post('/', function(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect(route('tasks_index'))
                            ->withInput()
                            ->withErrors($validator);
        }
        $task = new App\Task();
        $task->name = $request->name;
        $task->save();
        return redirect(route('tasks_index'));
    })->name('tasks_store');
    Route::delete('/{task}', function(Task $task) {
        $task->delete();
        return redirect(route('tasks_index'));
    })->name('tasks_destroy');
    Route::get('/{task}/edit', function (Task $task) {
        return view('tasks.edit', [
            'task' => $task,
        ]);
    })->name('tasks_edit');
    Route::put('/{task}', function(Request $request, Task $task) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect(route('tasks_edit', $task->id))
                            ->withInput()
                            ->withErrors($validator);
        }
        $task->name = $request->name;
        $task->save();
        return redirect(route('tasks_index'));
    })->name('tasks_update');
});

