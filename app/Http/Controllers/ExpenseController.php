<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $income = new Expense($validatedData);
        $income->user_id = auth()->user()->id;
        $income->save();

        return redirect()->route('incomes.index');
    }
    public function netIncome(Request $request)
    {
    $totalIncome = auth()->user()->incomes()->sum('amount');
    $totalExpenses = auth()->user()->expenses()->sum('amount');
    $netIncome = $totalIncome - $totalExpenses;
    return redirect()->route('incomes.index');
    }

}
