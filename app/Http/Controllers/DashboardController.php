<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $dataInicio = $request->input('inicio', Carbon::now()->startOfDay()->toDateString());
        $dataFim = $request->input('fim', Carbon::now()->endOfDay()->toDateString());

        $dia = Venda::selectRaw('produto, SUM(quantidade) as vendas, SUM(quantidade * valor_unitario) as fat')
            ->whereDate('data_venda', Carbon::now())
            ->groupBy('produto')
            ->get();

        $semana = Venda::selectRaw('produto, SUM(quantidade) as vendas, SUM(quantidade * valor_unitario) as fat')
            ->whereBetween('data_venda', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('produto')
            ->get();

        $mes = Venda::selectRaw('produto, SUM(quantidade) as vendas, SUM(quantidade * valor_unitario) as fat')
            ->whereMonth('data_venda', Carbon::now()->month)
            ->groupBy('produto')
            ->get();

        $periodo = Venda::selectRaw('produto, SUM(quantidade) as vendas, SUM(quantidade * valor_unitario) as fat')
            ->whereBetween('data_venda', [$dataInicio, $dataFim])
            ->groupBy('produto')
            ->get();

        return view('dashboard', compact('dia', 'semana', 'mes', 'periodo', 'dataInicio', 'dataFim'));
    }
}
