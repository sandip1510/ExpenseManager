@extends('layouts.app')

@section('content')
    <a href="{{ route('expenses.create') }}" class="btn btn-primary mb-3">Add Expense</a>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('expenses.index') }}" class="mb-3">
        <input type="text" name="search" class="form-control mb-2" placeholder="Search title..." value="{{ request('search') }}">
        <input type="date" name="date" class="form-control mb-2" value="{{ request('date') }}">
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

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
