<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\Category;

class ExpenseController extends Controller
{
    /**
     * Display a listing of expenses.
     */
    public function index(Request $request)
    {
        $query = Expense::where('user_id', auth()->id()); // Ensure users see only their expenses
    
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
    
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }
    
        $expenses = $query->latest()->paginate(10);
    
        return view('expenses.index', compact('expenses'));
    }
    
    

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
    public function store(Request $request) {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);
    
        Expense::create([
            'user_id' => Auth::id(), // Assign the currently logged-in user
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);
    
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
