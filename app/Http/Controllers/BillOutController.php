<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::query()->where('type', 'out')->get();

        return view('admin.bills-out.list', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = User::all();

        return view('admin.bills-out.form', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['type'] = 'out';
        $data['competence'] = Carbon::createFromFormat('d/m/Y', '01/' . $request->competence)->format('Y-m-d');
        $data['due_date'] = !empty($request->due_date)
            ? Carbon::createFromFormat('d/m/Y', $request->due_date)->format('Y-m-d')
            : null;
        $data['nf_issue'] = !empty($request->nf_issue)
            ? Carbon::createFromFormat('d/m/Y', $request->nf_issue)->format('Y-m-d')
            : null;

        if (isset($request->id)) {
            // Edit
            $bill = Bill::findOrFail($request->id);

            $bill->update($data);

            $message = 'Conta editado com sucesso';
        } else {
            // Create
            Bill::create($data);

            $message = 'Conta criado com sucesso';
        }

        return redirect()->route('bills-out.index')->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $bill = Bill::findOrFail($id);
        $clients = User::all();

        return view('admin.bills-out.form', compact('bill', 'clients'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $bill = Bill::query()
            ->where('id', $id)
            ->where('type', 'out')
            ->firstOrFail();

        $bill->delete();

        return redirect()->route('bills-out.index')->with('message', 'Conta excluído com sucesso');
    }
}
