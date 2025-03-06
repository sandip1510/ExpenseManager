@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg mt-10">
        <h1 class="text-2xl font-bold text-center mb-6 text-gray-700">💰 Expenses</h1>

        <!-- Add Expense Button -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('expenses.create') }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
                ➕ Add Expense
            </a>
        </div>

        @if($expenses->isEmpty())
            <p class="text-gray-500 text-center">No expenses found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 text-left">
                            <th class="border px-4 py-3">📌 Title</th>
                            <th class="border px-4 py-3">💵 Amount</th>
                            <th class="border px-4 py-3">📅 Date</th>
                            <th class="border px-4 py-3 text-center">⚙️ Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $expense)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border px-4 py-3">{{ $expense->title }}</td>
                                <td class="border px-4 py-3">${{ number_format($expense->amount, 2) }}</td>
                                <td class="border px-4 py-3">{{ $expense->date }}</td>
                                <td class="border px-4 py-3">
                                    <div class="flex justify-center gap-2">
                                        <!-- View Button -->
                                        <a href="{{ route('expenses.show', $expense) }}" 
                                           class="flex items-center gap-1 bg-blue-500 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-600 transition">
                                            🔍 View
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('expenses.edit', $expense) }}" 
                                           class="flex items-center gap-1 bg-yellow-500 text-white px-3 py-1 rounded-lg shadow hover:bg-yellow-600 transition">
                                            ✏️ Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="flex items-center gap-1 bg-red-500 text-white px-3 py-1 rounded-lg shadow hover:bg-red-600 transition">
                                                🗑 Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
