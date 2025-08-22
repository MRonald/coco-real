<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.list', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (isset($request->id)) {
            // Edit
            $role = Role::findOrFail($request->id);

            $role->update($request->all());

            $message = 'Cargo editado com sucesso';
        } else {
            // Create
            Role::create($request->all());

            $message = 'Cargo criado com sucesso';
        }

        return redirect()->route('roles.index')->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $role = Role::findOrFail($id);

        return view('admin.roles.form', compact('role'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        return redirect()->route('roles.index')->with('message', 'Cargo excluído com sucesso');
    }
}
