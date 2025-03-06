@extends('layouts.app')

@section('content')
    <h3>Edit Expense</h3>
    <form action="{{ route('expenses.update', $expense) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $expense->title }}" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" class="form-control" step="0.01" value="{{ $expense->amount }}" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $expense->date }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description (Optional)</label>
            <textarea name="description" class="form-control">{{ $expense->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update Expense</button>
        <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
