<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
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
            $users = User::all()->sortBy('nameComplete');

            return View('users', [
                'users' => $users
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->mod_id === 1)
        {
            return view('updateUser', [
                'user' => $user
            ]);
        }
        return redirect()->route('tasks');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (Auth::user()->mod_id === 1)
        {
            $credentials = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'nameComplete' => 'required|string|max:255',
                'mod_id' => 'required|int'

            ]);
            //dd($credentials, $request);
            if($user->update($credentials))
            {
                return redirect()->route('users');
            }
            else
            {
                return redirect()->back()->withErrors(['Error ao Atualizar Usuário: '.$user->nameComplete]);
            }
        }
        return redirect()->route('tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->mod_id === 1)
        {
            if ($user->delete())
            {
                return redirect()->route('users');
            }
            else
            {
                return redirect()->back()->withErrors(['Error ao Deletar Usuário']);
            }
        }
        return redirect()->route('tasks');
    }
}
