<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\Category;
use App\Http\Requests\StoreExpenseRequest; // Import the Form Request class
use App\DataTables\ExpenseDataTable;


class ExpenseController extends Controller
{

    

    public function index(ExpenseDataTable $dataTable)
    {
        return $dataTable->render('expenses.index');
    }
    /**
     * Display a listing of expenses.
     */
    // public function index(Request $request)
    // {
    //     $query = Expense::where('user_id', auth()->id()); // Ensure users see only their expenses
    
    
    //     $expenses = $query->orderBy('date','desc')->get();
    
    //     return view('expenses.index', compact('expenses'));
    // }

    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $expenses = Expense::where('user_id', auth()->id())->with('category')->orderBy('date', 'desc');

    //         return DataTables::of($expenses)
    //             ->addColumn('action', function ($expense) {
    //                 return view('expenses.partials.actions', compact('expense'))->render();
    //             })
    //             ->editColumn('amount', function ($expense) {
    //                 return '$' . number_format($expense->amount, 2);
    //             })
    //             ->make(true);
    //     }

    //     return view('expenses.index');
    // }
    
    

    /**
     * Show the form for creating a new expense.
     */
    public function create() {
        $categories = Category::all(); // Fetch all categories
        return view('expenses.create', compact('categories'));
    }
    

    /**
     * Store a newly created expense in storage.
     */
    

    public function store(StoreExpenseRequest $request) // Use the Form Request for validation
    {
        // Create the expense using the validated data
        $expense = Expense::create([
            'user_id' => Auth::id(), // Assign the currently logged-in user
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);
    
        // Redirect with a success message
        return redirect()->route('expenses.index')->with('success', 'Expense added successfully!');
    }
    
    public function addCategory(Request $request) {
        $request->validate(['name' => 'required|unique:categories,name']);

        $category = Category::create(['name' => $request->name]);

        return response()->json($category);
    }

    /**
     * Display the specified expense.
     */
    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified expense.
     */
    public function edit(Expense $expense) {
        $categories = Category::all(); // Fetch categories
        return view('expenses.edit', compact('expense', 'categories'));
    }
    

    /**
     * Update the specified expense in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id', // Validate category exists
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);
    
        $expense->update([
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);
    
        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
    }
    

    /**
     * Remove the specified expense from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }
}
