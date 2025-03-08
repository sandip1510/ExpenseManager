@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-3xl font-bold text-gray-800">Expense List</h2>
            
            <!-- Add Expense Button -->
            <a href="{{ route('expenses.create') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md">
                + Add Expense
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-4">
            {!! $dataTable->table(['class' => 'w-full rounded-lg overflow-hidden']) !!}
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
