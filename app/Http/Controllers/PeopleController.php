<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index()
    {
        $people = Person::query()
            ->when(request('status'), function($query) {
                $query->where('status', request('status'));
            })
            ->when(request('nature'), function($query) {
                $query->where('nature', request('nature'));
            })
            ->when(request('condition'), function($query) {
                $conditions = explode(',', request('condition'));
                $query->where(function($q) use ($conditions) {
                    foreach ($conditions as $condition) {
                        $q->orWhere($condition, true);
                    }
                });
            })
            ->when(request('name'), function($query) {
                $query->where('name', 'like', '%'.request('name').'%');
            })
            ->when(request('document'), function($query) {
                $document = preg_replace('/[^0-9]/', '', request('document'));
                $query->where('document', 'like', '%'.$document.'%');
            })
            ->orderBy('name')
            ->paginate(15);

        $states = [
            'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
            'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo', 'GO' => 'Goiás', 'MA' => 'Maranhão',
            'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul', 'MG' => 'Minas Gerais',
            'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná', 'PE' => 'Pernambuco',
            'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima',
            'SC' => 'Santa Catarina', 'SP' => 'São Paulo', 'SE' => 'Sergipe',
            'TO' => 'Tocantins'
        ];

        return view('people.index', compact('people', 'states'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nature' => 'required|in:physical,legal',
            'document' => 'required|string',
            'ie' => 'nullable|string',
            'icms_taxpayer' => 'nullable|boolean',
            'business_unit' => 'nullable|string',
            'cep' => 'nullable|string',
            'address' => 'nullable|string',
            'number' => 'nullable|string',
            'complement' => 'nullable|string',
            'neighborhood' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'is_client' => 'nullable|boolean',
            'is_employee' => 'nullable|boolean',
            'is_supplier' => 'nullable|boolean',
            'is_partner' => 'nullable|boolean',
        ]);

        $validated['document'] = preg_replace('/[^0-9]/', '', $validated['document']);
        $validated['phone'] = preg_replace('/[^0-9]/', '', $validated['phone'] ?? '');
        $validated['cep'] = preg_replace('/[^0-9]/', '', $validated['cep'] ?? '');

        Person::create($validated);

        return redirect()->route('people.index')
            ->with('success', 'Pessoa cadastrada com sucesso!');
    }

    public function update(Request $request, Person $person)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nature' => 'required|in:physical,legal',
            'document' => 'required|string',
            'ie' => 'nullable|string',
            'icms_taxpayer' => 'nullable|boolean',
            'business_unit' => 'nullable|string',
            'cep' => 'nullable|string',
            'address' => 'nullable|string',
            'number' => 'nullable|string',
            'complement' => 'nullable|string',
            'neighborhood' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'is_client' => 'nullable|boolean',
            'is_employee' => 'nullable|boolean',
            'is_supplier' => 'nullable|boolean',
            'is_partner' => 'nullable|boolean',
        ]);

        $validated['document'] = preg_replace('/[^0-9]/', '', $validated['document']);
        $validated['phone'] = preg_replace('/[^0-9]/', '', $validated['phone'] ?? '');
        $validated['cep'] = preg_replace('/[^0-9]/', '', $validated['cep'] ?? '');

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
