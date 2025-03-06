@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">
        <h3 class="text-2xl font-bold text-gray-800 border-b pb-2 mb-4">✏️ Edit Expense</h3>

        <form action="{{ route('expenses.update', $expense) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium">📌 Title</label>
                <input type="text" name="title" value="{{ $expense->title }}" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-gray-700 font-medium">💵 Amount</label>
                <input type="number" name="amount" value="{{ $expense->amount }}" step="0.01"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-medium">📅 Date</label>
                <input type="date" name="date" value="{{ $expense->date }}"
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
@endsection
