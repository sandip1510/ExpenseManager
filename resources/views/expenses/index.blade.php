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
        <div x-show="tab === 'expenses'" class="p-4">
            <h2 class="text-xl font-semibold mb-4">Expense List</h2>
            <div>
                {!! $dataTable->table(['class' => 'w-full']) !!}
            </div>
        </div>

        <!-- Categories Table -->
        <div x-show="tab === 'categories'" class="p-4">
            <h2 class="text-xl font-semibold mb-4">Categories</h2>
            <table id="categories-table" class="w-full rounded-lg overflow-hidden">
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
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
