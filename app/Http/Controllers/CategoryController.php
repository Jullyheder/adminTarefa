<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Priority;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CategoryController extends Controller
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
            $categories = Category::all()->sortByDesc('priority_id');

            return View('categories', [
                'categories' => $categories
            ]);
        }
        return redirect()->route('tasks');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->mod_id === 1)
        {
            $priorities = Priority::all()->sortBy('priority_id');

            return View('cadCategory', [
                'priorities' => $priorities
            ]);
        }
        return redirect()->route('tasks');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->mod_id === 1)
        {
            $credentials = $request->validate([
                'category_desc' => 'required|string|max:255|unique:categories',
                'priority_id' => 'required|int'
            ]);
            if(Category::create($credentials))
            {
                return redirect()->route('categories');
            }
            else
            {
                return redirect()->back()->withErrors(['Error ao cadastrar categoria!']);
            }
        }
        return redirect()->route('tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (Auth::user()->mod_id === 1)
        {
            $priorities = Priority::all()->sortBy('priority_id');
            return view('updateCategory', [
                'category' => $category,
                'priorities' => $priorities
            ]);
        }
        return redirect()->route('tasks');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if (Auth::user()->mod_id === 1)
        {
            $credentials = $request->validate([
                'category_desc' => 'required|string|max:255|unique:categories',
                'priority_id' => 'required|int'

            ]);
            if($category->update($credentials))
            {
                return redirect()->route('categories');
            }
            else
            {
                return redirect()->back()->withErrors(['Error ao Atualizar Categoria: '.$category->category_desc]);
            }
        }
        return redirect()->route('tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (Auth::user()->mod_id === 1)
        {
            if ($category->delete())
            {
                return redirect()->route('categories');
            }
            else
            {
                return redirect()->back()->withErrors(['Error ao Deletar categoria']);
            }
        }
        return redirect()->route('tasks');
    }
}
