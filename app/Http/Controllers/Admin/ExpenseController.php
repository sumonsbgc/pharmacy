<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    public function index(){
        $expenses = Expense::orderBy('updated_at', 'desc')->get();
        return view('admin.expenses.index', compact('expenses'));
    }

    public function create(){
        return view('admin.expenses.create');
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'account_name' => ['required', 'string', 'max:150'],
            'account_code' => ['nullable', 'string', 'max:10'],
            'expense_amount' => ['required'],
            'narration' => ['nullable'],
            'transaction_date' => ['required', 'date'],
        ]);

        if($valid->fails()){
            return redirect()->back()->withInput()->withErrors($valid);
        }

        $expense = new Expense();

        $expense->user_id = Auth::user()->id;
        $expense->account_name = $request->account_name;
        $expense->account_code = $request->account_code ?? '';
        $expense->expense_amount = $request->expense_amount ?? '';
        $expense->narration = $request->narration ?? '';
        $expense->transaction_date = Carbon::create($request->transaction_date)->format('Y-m-d H:i');

        $expense->save();

        return redirect()->route('admin.expenses.index')->with(['status' => 'success', 'message' => 'Expense Record has been created successfully']);
    }

    public function edit(Expense $expense){
        return view('admin.expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense){

        $valid = Validator::make($request->all(), [
            'account_name' => ['required', 'string', 'max:150'],
            'account_code' => ['nullable', 'string', 'max:10'],
            'expense_amount' => ['required'],
            'narration' => ['nullable'],
            'transaction_date' => ['required', 'date'],
        ]);

        if($valid->fails()){
            return redirect()->back()->withInput()->withErrors($valid);
        }

        $expense->user_id = Auth::user()->id;
        $expense->account_name = $request->account_name;
        $expense->account_code = $request->account_code ?? '';
        $expense->expense_amount = $request->expense_amount ?? '';
        $expense->narration = $request->narration ?? '';
        $expense->transaction_date = Carbon::create($request->transaction_date)->format('Y-m-d H:i');


        $expense->save();

        return redirect()->route('admin.expenses.index')->with(['status' => 'success', 'message' => 'Expense Record has been updated successfully']);
    }

    public function delete(Expense $expense){
        $expense->delete();
        return redirect()->back()->with(['status' => 'success', 'message' => 'Expense Record has been deleted successfully']);
    }
}
