@extends('layouts.app')

@section('content')
    <a href="{{ route('expenses.create') }}" class="btn btn-primary mb-3">Add Expense</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->title }}</td>
                    <td>${{ number_format($expense->amount, 2) }}</td>
                    <td>{{ $expense->date }}</td>
                    <td>
                        <a href="{{ route('expenses.show', $expense) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
