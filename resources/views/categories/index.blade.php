@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Categories</h2>

        <div class="bg-white shadow-lg rounded-lg p-4">
        <table id="categories-table" class="display w-full rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 text-left">ID</th>
                    <th class="p-2 text-left">Category Name</th>
                    <th class="p-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody></tbody> <!-- Important: This must be present! -->
        </table>


        </div>
    </div>
@endsection
