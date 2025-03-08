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
            

            <form action="{{ route('expenses.edit', $expense->id) }}" method="GET">
                <button type="submit"
                class="flex items-center gap-1 bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 transition">
                    <i class="fas fa-edit mr-1"></i> ⬅️ Back
                </button>
            </form>


            <form action="{{ route('expenses.edit', $expense->id) }}" method="GET">
                <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white px-4 py-2  rounded-lg hover:bg-green-600 transition flex items-center">
                    <i class="fas fa-edit mr-1"></i> ✏️ Edit
                </button>
            </form>

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
