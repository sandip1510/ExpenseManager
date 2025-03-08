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
        
                
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#expenses-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('expenses.index') }}",
                    columns: [
                        { data: 'category.name', name: 'category.name' },
                        { data: 'amount', name: 'amount' },
                        { data: 'date', name: 'date' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
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
