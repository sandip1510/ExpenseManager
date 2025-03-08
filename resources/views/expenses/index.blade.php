@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Expense List</h2>
        <div class="card shadow-sm p-3">
            {!! $dataTable->table(['class' => 'table table-striped table-bordered']) !!}
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
