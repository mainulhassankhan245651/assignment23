<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{

    function IncomeCreate(Request $request){
        return Income::create([
            'amount'=>$request->input('amount'),
            'user_id'=>$request->input('user_id'),
            'description'=>$request->input('description'),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $income = new Income($validatedData);
        $income->user_id = auth()->user()->id;
        $income->save();

        return redirect()->route('incomes.index');
    }

    public function index()
    {
        $incomes =Income::get()->paginate(10);
        return $incomes;
        // return view('incomes.index', compact('incomes'));
    }

    // public function edit(Income $income)
    // {
    //     return view('incomes.edit', compact('income'));
    // }

    
    // public function update(Request $request, Income $income)
    // {
    //     $validatedData = $request->validate([
    //         'amount' => 'required|numeric',
    //         'description' => 'required|string',
    //         'date' => 'required|date',
    //     ]);

    //     $income->update($validatedData);
    //     return redirect()->route('incomes.index');
    // }


    // public function destroy(Income $income)
    // {
    //     $income->delete();
    //     return redirect()->route('incomes.index');
    // }


    // // public function index(Request $request)
    // // {
    // //     $filteredIncomes = auth()->user()->incomes();

    // //     if ($request->has('category')) {
    // //         $filteredIncomes->where('category', $request->category);
    // //     }

    // //     if ($request->has('sort')) {
    // //         if ($request->sort === 'date_asc') {
    // //             $filteredIncomes->orderBy('date', 'asc');
    // //         } elseif ($request->sort === 'date_desc') {
    // //             $filteredIncomes->orderBy('date', 'desc');
    // //         } elseif ($request->sort === 'amount_asc') {
    // //             $filteredIncomes->orderBy('amount', 'asc');
    // //         } elseif ($request->sort === 'amount_desc') {
    // //             $filteredIncomes->orderBy('amount', 'desc');
    // //         }
    // //     }

    // //     $incomes = $filteredIncomes->paginate(10);
    // //     return view('incomes.index', compact('incomes'));
    // // }



    public function netIncome(Request $request)
    {
    $totalIncome=auth()->user()->Income::sum('amount');
    $totalExpenses=auth()->user()->Expense::sum('amount');
    // $totalIncome = auth()->user()->incomes()->sum('amount');
    // $totalExpenses = auth()->user()->expenses()->sum('amount');
    $netIncome = $totalIncome - $totalExpenses;
    return redirect()->route('incomes.index');
    }

}
