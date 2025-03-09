@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">
            {{ $category->name }} - Expenses
        </h2>

        <!-- Total Amount -->
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg mb-4">
            <strong>Total Amount:</strong> ${{ number_format($totalAmount, 2) }}
        </div>

        <!-- Expenses Table -->
        <div class="bg-white shadow-lg rounded-lg p-4">
            <table id="category-expenses-table" class="w-full rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 text-left">Date</th>
                        <th class="p-2 text-left">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                        <tr class="border-t">
                            <td class="p-2">{{ $expense->date }}</td>
                            <td class="p-2">${{ number_format($expense->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $expenses->links() }}
        </div>
    </div>
@endsection
