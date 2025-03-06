@extends('layouts.app')

@section('content')
    <h3>Expense Details</h3>
    <p><strong>Title:</strong> {{ $expense->title }}</p>
    <p><strong>Amount:</strong> ${{ number_format($expense->amount, 2) }}</p>
    <p><strong>Date:</strong> {{ $expense->date }}</p>
    <p><strong>Description:</strong> {{ $expense->description }}</p>

    <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('expenses.destroy', $expense) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
@endsection
