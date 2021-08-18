<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        jQuery(function () { 

            $.fn.dataTable.ext.search.push(
                function( settings, searchData, index, rowData, counter ) {
                var categories = $('input:checkbox[name="category"]:checked').map(function() {
                    return this.value;
                }).get();
            
                if (categories.length === 0) {
                    return true;
                }
                
                if (categories.indexOf(searchData[1]) !== -1) {
                    return true;
                }
                
                return false;
                }
            );

            var table = $('#itemTable').DataTable({
                columnDefs: [
                    {
                        targets: '_all',
                        className: 'dt-body-center'
                    },
                    {
                        orderable: false, targets: -1
                    }

                ]
            });

            $('input:checkbox').on('change', function () {
                table.draw();
            });

        });
    </script>
    @stack('scripts')
    </body>
</html>
