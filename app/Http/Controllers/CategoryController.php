<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\DataTables\CategoryDataTable;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest; // Import the Form Request class
use App\DataTables\ExpenseDataTable;

class CategoryController extends Controller
{

    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('categories.index');
    }


    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories']);
        
        $category = Category::create(['name' => $request->name]);

        return response()->json([
            'success' => true,
            'category' => $category
        ]);
    }

    public function show(Category $category)
    {
        // Get all expenses for this category
        $expenses = $category->expenses()->latest()->paginate(10);

        // Calculate total amount
        $totalAmount = $category->expenses()->sum('amount');

        return view('categories.show', compact('category', 'expenses', 'totalAmount'));
    }

}
