<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts & Styles -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">

        <style>
        </style>
        <!-- <script src="https://cdn.tailwindcss.com"></script> -->
        
                
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
       
        <script>
            $(document).ready(function () {
                let table = $('#expenses-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('expenses.index') }}",
                    columns: [
                        { data: 'category.name', name: 'category.name' },
                        { data: 'amount', name: 'amount' },
                        { data: 'date', name: 'date' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ],
                    dom: '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>',
                    language: {
                        search: "",
                        searchPlaceholder: "Search expenses...",
                        lengthMenu: "Show _MENU_ entries"
                    }
                });

                // Style search input
                $(".dataTables_filter input")
                    .addClass("border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 outline-none");

                // Style pagination buttons after DataTable initializes
                setTimeout(() => {
                    $(".dataTables_paginate .paginate_button")
                        .addClass("px-4 py-2 mx-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-blue-500 hover:text-white transition cursor-pointer border border-gray-300");

                    $(".dataTables_paginate .paginate_button.current")
                        .addClass("bg-blue-500 text-white font-bold border-blue-500");
                    
                    $(".dataTables_paginate .paginate_button.disabled")
                        .addClass("opacity-50 cursor-not-allowed bg-gray-300 text-gray-500");
                }, 500);
            });
        </script>

        <script>
            
            $(document).ready(function () {
    let tableElement = $('#categories-table');
    
    if (tableElement.length) {  // Ensure the table exists before initializing DataTable
        let table = tableElement.DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('categories.index') }}",
            columns: [
                { data: 'id', name: 'id', defaultContent: '' }, 
                { data: 'name', name: 'name', defaultContent: '' }, 
                { data: 'total_amount', name: 'total_amount', defaultContent: '' }, 
                { data: 'action', name: 'action', orderable: false, searchable: false, defaultContent: '' }
            ],
            dom: '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>',
            language: {
                search: "",
                searchPlaceholder: "Search categories...",
                lengthMenu: "Show _MENU_ entries"
            },
            drawCallback: function () {
                $(".dataTables_paginate .paginate_button")
                    .addClass("px-4 py-2 mx-1 border border-gray-300 rounded-lg bg-gray-200 text-gray-700 hover:bg-blue-500 hover:text-white transition-all duration-300");
            }
        });
    } else {
        console.error("Error: #categories-table not found on the page.");
    }
});

        </script>



        @vite(['resources/css/app.css', 'resources/js/app.js'])

        
    </head>
    <body class="font-sans antialiased bg-gray-100 ">
        <div class="min-h-screen">
            @include('layouts.navigation')
            
            <!-- Page Header with Profile Info -->
            <header class="bg-white  shadow py-4 px-6 flex justify-between items-center">
                <div class="text-xl font-semibold text-gray-800 ">
                    @yield('header', 'Welcome')
                </div>
                <div class="text-gray-700 ">
                    {{ Auth::user()->name }} |
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:underline">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </body>
</html>
