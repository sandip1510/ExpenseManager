@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">
        <h3 class="text-2xl font-bold text-gray-800 border-b pb-2 mb-4">💰 Expense Details</h3>

        <div class="space-y-3 text-gray-700">
            <p class="text-lg"><strong class="font-semibold">📌 Title:</strong>  {{ $expense->category->name }}</p>
            <p class="text-lg"><strong class="font-semibold">💵 Amount:</strong> 
                <span class="text-green-600 font-bold">${{ number_format($expense->amount, 2) }}</span>
            </p>
            <p class="text-lg"><strong class="font-semibold">📅 Date:</strong> {{ $expense->date }}</p>

            @if($expense->description)
                <p class="text-lg"><strong class="font-semibold">📝 Description:</strong> {{ $expense->description }}</p>
            @endif
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('expenses.index') }}" 
               class="flex items-center gap-1 bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 transition">
                ⬅️ Back
            </a>

            <a href="{{ route('expenses.edit', $expense) }}" 
               class="flex items-center gap-1 bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600 transition">
                ✏️ Edit
            </a>

            <form action="{{ route('expenses.destroy', $expense) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="flex items-center gap-1 bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition">
                    🗑 Delete
                </button>
            </form>
        </div>
    </div>
@endsection
