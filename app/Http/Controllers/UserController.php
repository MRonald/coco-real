<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (isset($request->id)) {
            // Edit
            $user = User::findOrFail($request->id);

            if (!empty($request->password)) {
                $data = $request->all();
            } else {
                $data = $request->except('password');
            }

            $user->update($data);

            $message = 'Usuário editado com sucesso';
        } else {
            // Create
            User::create($request->all());

            $message = 'Usuário criado com sucesso';
        }

        return redirect()->route('users.index')->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.form', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.index')->with('message', 'Usuário excluído com sucesso');
    }
}
