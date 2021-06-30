<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Priority;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->mod_id === 1)
        {
            $tasks = Task::all()->sortByDesc('priority_id');
            return View('tasks', [
                'tasks' => $tasks,
            ]);
        }
        else
        {
            $tasks = Task::where('user_id', Auth::user()->id)->get();
            return View('tasks', [
                'tasks' => $tasks,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $priorities = Priority::all()->sortBy('priority_id');
        return view('cadTask', [
            'priorities' => $priorities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->data_limit !== null)
        {
            if (strtotime($request->data_limit) < strtotime(date('d-m-Y')))
            {
                return redirect()->back()->withErrors(['Data limite informada não pode ser menor que a data atual']);
            }
        }
        $credentials = $request->validate([
            'task_desc' => 'required|string|max:255',
            'category_id' => 'int',
            'priority_id' => 'required|int',
            'data_limit' => 'date',
            'annotate' => 'string|max:1500'
        ]);
        $credentials['situation_id'] = 1;
        $credentials['user_id'] = Auth::user()->id;
        if(Task::create($credentials))
        {
            return redirect()->route('tasks');
        }
        else
        {
            return redirect()->back()->withErrors(['Error ao cadastrar tarefa!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if (Auth::user()->mod_id === 1)
        {
            if ($task->delete())
            {
                return redirect()->route('tasks');
            }
            else
            {
                return redirect()->back()->withErrors(['Error ao deletar tarefa']);
            }
        }
        else
        {
            if ($task->user_id === Auth::user()->id)
            {
                if ($task->delete())
                {
                    return redirect()->route('tasks');
                }
                else
                {
                    return redirect()->back()->withErrors(['Error ao deletar tarefa']);
                }
            }
            else
            {
                return redirect()->back()->withErrors(['Sem permissão para deletar essa tarefa']);
            }
        }

    }

    public function getautocomplete(Request $request)
    {
        //dd($request);
        $search = $request->search;

        if($search == ''){
            $autocomplate = Category::orderby('category_desc','asc')->select('id','category_desc','priority_id')->limit(5)->get();
        }else{
            $autocomplate = Category::orderby('category_desc','asc')->select('id','category_desc','priority_id')->where('category_desc', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();
        foreach($autocomplate as $autocomplate){
            $response[] = array("value"=>$autocomplate->id,"label"=>$autocomplate->category_desc,"priority"=>$autocomplate->priority_id);
        }
        //dd($response);
        echo json_encode($response);
        exit;
    }
}
