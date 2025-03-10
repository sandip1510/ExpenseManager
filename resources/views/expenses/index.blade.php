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
        <div x-show="tab === 'categories'" class="p-4">
            <h2 class="text-xl font-semibold mb-4">Categories</h2>
            <div class="mb-4">
                <!-- <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a> -->
                
                <button type="button" id="add-category-btn" class="ml-2 bg-blue-500 text-white px-3 py-2 rounded-lg shadow hover:bg-blue-600 transition">+ Add Category</button>
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


<!-- Add Category Modal -->
<div id="category-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-5 rounded-lg shadow-lg">
        <h3 class="text-lg font-bold mb-3">Add New Category</h3>
        <input type="text" id="new-category" placeholder="Enter category name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        <div class="flex justify-end mt-3">
            <button id="close-modal" class="ml-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Cancel</button>
            <button id="save-category" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Save</button>
            
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush


<script>
    document.addEventListener("DOMContentLoaded", function () {
        

        // Open modal
        document.getElementById("add-category-btn").addEventListener("click", function () {
            document.getElementById("category-modal").classList.remove("hidden");
        });

        // Close modal
        document.getElementById("close-modal").addEventListener("click", function () {
            document.getElementById("category-modal").classList.add("hidden");
        });

        // Save new category
        document.getElementById("save-category").addEventListener("click", function () {
            let categoryName = document.getElementById("new-category").value.trim();
            if (!categoryName) return alert("Category name is required.");

            fetch("{{ route('add.category') }}", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}", "Content-Type": "application/json" },
                body: JSON.stringify({ name: categoryName })
            })
            .then(response => response.json())
            .then(category => {
                let newOption = document.createElement("option");
                newOption.value = category.id;
                newOption.text = category.name;
                document.getElementById("category_id").appendChild(newOption);
                document.getElementById("category-modal").classList.add("hidden");
                document.getElementById("new-category").value = "";
            })
            .catch(error => alert("Error adding category!"));
        });
    });
</script>