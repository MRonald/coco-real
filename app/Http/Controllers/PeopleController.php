<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index()
    {
        $people = Person::query()
            ->when(request('search'), function($query) {
                $query->where('name', 'like', '%'.request('search').'%');
            })
            ->when(request('type'), function($query) {
                $type = request('type');
                if ($type === 'client') {
                    $query->where('is_client', true);
                } elseif ($type === 'supplier') {
                    $query->where('is_supplier', true);
                } elseif ($type === 'employee') {
                    $query->where('is_employee', true);
                }
            })
            ->orderBy('name')
            ->paginate(15);

        return view('people.index', compact('people'));
    }

    public function create()
    {
        return view('people.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'is_client' => 'nullable|boolean',
            'is_supplier' => 'nullable|boolean',
            'is_employee' => 'nullable|boolean',
        ]);

        Person::create($validated);

        return redirect()->route('people.index')
            ->with('success', 'Pessoa cadastrada com sucesso!');
    }

    public function edit(Person $person)
    {
        return view('people.edit', compact('person'));
    }

    public function update(Request $request, Person $person)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'is_client' => 'nullable|boolean',
            'is_supplier' => 'nullable|boolean',
            'is_employee' => 'nullable|boolean',
        ]);

        $person->update($validated);

        return redirect()->route('people.index')
            ->with('success', 'Pessoa atualizada com sucesso!');
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return redirect()->route('people.index')
            ->with('success', 'Pessoa excluída com sucesso!');
    }
}
