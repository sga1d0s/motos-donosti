<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App Motos - @yield('title')</title>

    <!-- PWA Manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Theme & Background Colors -->
    <meta name="theme-color" content="#007aff">
    <meta name="background-color" content="#ffffff">

    <!-- Apple PWA Meta Tags -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="App Motos">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="apple-touch-icon" href="{{ asset('icons/apple-touch-icon.png') }}">

    <style>
        /* Básicos */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 1rem;
        }

        h1,
        h2 {
            margin: .5rem 0;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Formulario y botones */
        form {
            margin: 1rem 0;
        }

        input,
        select,
        textarea,
        button {
            width: 100%;
            padding: .75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        button {
            cursor: pointer;
        }

        button.primary {
            background: #007BFF;
            color: #fff;
            border: none;
        }

        button.delete {
            background: #dc3545;
            color: #fff;
            border: none;
        }

        /* Tabla responsive */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        th,
        td {
            padding: .5rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        @media (max-width: 600px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            tr {
                margin-bottom: 1rem;
            }

            th {
                background: #f0f0f0;
                font-weight: bold;
            }

            td {
                position: relative;
                padding-left: 50%;
            }

            td:before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: .5rem;
                font-weight: bold;
            }
        }

        footer {
            display: flex;
            justify-content: space-around
        }

        footer button {
            max-width: 30%;
        }
    </style>
</head>

<body>
    <div class="container">
        @yield('content')
    </div>

    {{-- Solo incluir el footer si NO estamos en la ruta 'login' --}}
    @unless (Route::is('login'))
        @include('footer')
    @endunless

    <!-- Service Worker Registration -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('{{ asset('sw.js') }}')
                    .then(function(reg) {
                        console.log('Service Worker registrado con scope:', reg.scope);
                    })
                    .catch(function(err) {
                        console.error('Error al registrar el Service Worker:', err);
                    });
            });
        }
    </script>
</body>

</html>
