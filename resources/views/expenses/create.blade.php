@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg mt-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Add Expense</h2>

    <form action="{{ route('expenses.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Category Dropdown -->
        <div>
            <label for="category_id" class="block text-gray-700 font-medium">Category</label>
            <div class="flex">
                <select name="category_id" id="category_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="button" id="add-category-btn" class="ml-2 bg-blue-500 text-white px-3 py-2 rounded-lg shadow hover:bg-blue-600 transition">+</button>
            </div>
        </div>

        <!-- Amount -->
        <div>
            <label for="amount" class="block text-gray-700 font-medium">Amount</label>
            <input type="number" name="amount" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" step="0.01" required>
        </div>

        <!-- Date (Defaults to Today) -->
        <div>
            <label for="date" class="block text-gray-700 font-medium">Date</label>
            <input type="date" id="date" name="date" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-gray-700 font-medium">Description (Optional)</label>
            <textarea name="description" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <div class="flex justify-between mt-4">
            <a href="{{ route('expenses.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">Save Expense</button>
        </div>
    </form>
</div>

<!-- Add Category Modal -->
<div id="category-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-5 rounded-lg shadow-lg">
        <h3 class="text-lg font-bold mb-3">Add New Category</h3>
        <input type="text" id="new-category" placeholder="Enter category name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        <div class="flex justify-end mt-3">
            <button id="save-category" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Save</button>
            <button id="close-modal" class="ml-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Cancel</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let today = new Date();
        let localDate = today.getFullYear() + '-' + 
                        String(today.getMonth() + 1).padStart(2, '0') + '-' + 
                        String(today.getDate()).padStart(2, '0'); 
        document.getElementById('date').value = localDate;

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
@endsection
