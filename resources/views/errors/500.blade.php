<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Error 500 - Error Interno del Servidor</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .gradient-text {
            background: linear-gradient(90deg, #3b82f6, #ec4899, #f59e0b);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            background-size: 300% 300%;
            animation: gradient 4s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .btn-hover {
            transition: all 0.3s ease;
            transform: scale(1);
        }

        .btn-hover:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col justify-between">
    <main class="flex-grow flex items-center justify-center px-4">
        <div class="text-center max-w-2xl">
            <div class="floating mb-8">
                <div class="relative inline-block">
                    <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-pink-500 rounded-lg blur opacity-75 animate-pulse"></div>
                    <div class="relative bg-white rounded-lg p-8 shadow-lg">
                        <h1 class="gradient-text text-9xl font-bold">500</h1>
                    </div>
                </div>
            </div>

            <h2 class="text-4xl font-bold mb-4 text-gray-900">¡Vaya! Algo salió mal</h2>
            <p class="text-xl text-gray-600 mb-8">
                Estamos experimentando un error en el servidor. Por favor, inténtalo más tarde.
            </p>

            <div>
                <div class="flex justify-center space-x-4">
                    <a href="{{ url()->previous() }}" class="btn-hover bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold py-3 px-6 rounded-full inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Volver atrás
                    </a>
                    <a href="{{ route('panel') }}" class="btn-hover bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold py-3 px-6 rounded-full inline-flex items-center">
                        <i class="fas fa-home mr-2"></i>
                        Ir al inicio
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-6 bg-gray-200">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-500 text-sm">&copy; 2025 Pedro Ureña. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>
