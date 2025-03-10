@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <!-- Tabs -->
    <div x-data="{ tab: 'expenses' }">
        <div class="flex border-b">
            <button @click="tab = 'expenses'" 
                :class="tab === 'expenses' ? 'border-blue-500 text-blue-600' : 'text-gray-500'"
                class="px-4 py-2 text-sm font-medium border-b-2 focus:outline-none">
                Expenses
            </button>
            <button @click="tab = 'categories'" 
                :class="tab === 'categories' ? 'border-blue-500 text-blue-600' : 'text-gray-500'"
                class="px-4 py-2 text-sm font-medium border-b-2 focus:outline-none">
                Categories
            </button>
        </div>

        <!-- Expenses Table -->
        <!-- <div x-show="tab === 'expenses'" class="p-4">
            <h2 class="text-xl font-semibold mb-4">Expense List</h2>
            <div>
                {!! $dataTable->table(['class' => 'w-full']) !!}
            </div>
        </div> -->

        <!-- Expenses Table -->
        <div x-show="tab === 'expenses'" class="p-4">
            <h2 class="text-xl font-semibold mb-4">Expense List</h2>
            <div class="mb-4">
                <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Expense</a>
            </div>
            <div>
                {!! $dataTable->table(['class' => 'table table-striped table-bordered']) !!}
            </div>
        </div>

        <!-- Categories Table -->
        <!-- <div x-show="tab === 'categories'" class="p-4">
            <h2 class="text-xl font-semibold mb-4">Categories</h2>
            <table id="categories-table" class="w-full" style="width:100%">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Id</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Total Amount</th>
                        <th class="px-4 py-2">Action</th>                        
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div> -->

        <!-- Categories Table -->
<div x-show="tab === 'categories'" class="p-4">
    <h2 class="text-xl font-semibold mb-4">Categories</h2>
    <div class="mb-4">
        <!-- <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a> -->
    </div>
    <div class="table-responsive">
        <table id="categories-table" class="table table-striped table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Total Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
    </div>
</div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
