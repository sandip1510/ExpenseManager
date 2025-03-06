@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg mt-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">📝 Add Expense</h2>
        
        <form action="{{ route('expenses.store') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label for="title" class="block text-gray-700 font-medium">📌 Title</label>
                <input type="text" name="title" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" 
                       required>
            </div>
            
            <div>
                <label for="amount" class="block text-gray-700 font-medium">💵 Amount</label>
                <input type="number" name="amount" step="0.01" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" 
                       required>
            </div>
            
            <div>
                <label for="date" class="block text-gray-700 font-medium">📅 Date</label>
                <input type="date" id="date" name="date" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" 
                       required>
            </div>
            
            <div>
                <label for="description" class="block text-gray-700 font-medium">📝 Description (Optional)</label>
                <textarea name="description" 
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            
            <div class="flex justify-between mt-6">
                <a href="{{ route('expenses.index') }}" 
                   class="px-5 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">
                    ❌ Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">
                    💾 Save Expense
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let today = new Date();
            let localDate = today.toISOString().split('T')[0]; 
            document.getElementById('date').value = localDate;
        });
    </script>
@endsection
