@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">
        <h3 class="text-2xl font-bold text-gray-800 border-b pb-2 mb-4">✏️ Edit Expense</h3>

        <form action="{{ route('expenses.update', $expense) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Category Selection with Add Button -->
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-medium">📂 Category</label>
                <div class="flex gap-2">
                    <select name="category_id" id="category_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $expense->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" onclick="addCategory()"
                        class="px-3 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">
                        ➕ 
                    </button>
                </div>
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-gray-700 font-medium">💵 Amount</label>
                <input type="number" name="amount" value="{{ $expense->amount }}" step="0.01"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-medium">📅 Date</label>
                <input type="date" id="date" name="date" value="{{ $expense->date }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium">📝 Description (Optional)</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ $expense->description }}</textarea>
            </div>

            <div class="mt-6 flex gap-3">
                <button type="submit"
                    class="flex items-center gap-1 bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
                    💾 Update Expense
                </button>

                <a href="{{ route('expenses.index') }}"
                   class="flex items-center gap-1 bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 transition">
                    ⬅️ Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Add Category Modal (Hidden by Default) -->
    <div id="categoryModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-5 rounded-lg shadow-lg max-w-sm">
            <h3 class="text-xl font-bold text-gray-700 mb-3">➕ Add New Category</h3>
            <input type="text" id="newCategoryName" placeholder="Category Name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <div class="mt-4 flex justify-end gap-3">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">Cancel</button>
                <button onclick="saveCategory()" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">Save</button>
            </div>
        </div>
    </div>

    <script>
        function addCategory() {
            document.getElementById('categoryModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('categoryModal').classList.add('hidden');
        }

        function saveCategory() {
            let categoryName = document.getElementById('newCategoryName').value;
            if (!categoryName) {
                alert('Please enter a category name.');
                return;
            }

            fetch("{{ route('categories.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ name: categoryName })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let newOption = document.createElement("option");
                    newOption.value = data.category.id;
                    newOption.textContent = data.category.name;
                    newOption.selected = true;
                    document.getElementById("category_id").appendChild(newOption);
                    closeModal();
                } else {
                    alert('Error adding category.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
