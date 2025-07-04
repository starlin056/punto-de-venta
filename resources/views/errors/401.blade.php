<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Error 401</title>

    <!-- Tailwind CSS y Animate.css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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

<body class="bg-white min-h-screen flex flex-col justify-between">
    <main class="flex-grow flex items-center justify-center px-4">
        <div class="text-center max-w-2xl">
            <div class="floating mb-8">
                <div class="relative inline-block">
                    <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-pink-500 rounded-lg blur opacity-75 animate-pulse"></div>
                    <div class="relative bg-white rounded-lg p-8 shadow-lg">
                        <h1 class="gradient-text text-9xl font-bold">401</h1>
                    </div>
                </div>
            </div>

            <h2 class="text-4xl font-bold mb-4 animate__animated animate__fadeIn text-gray-900">No autorizado</h2>
            <p class="text-xl text-gray-600 mb-8 animate__animated animate__fadeIn animate__delay-1s">
                Lo sentimos, no tienes permisos para acceder a este recurso.
            </p>

            <div class="animate__animated animate__fadeInUp animate__delay-2s">
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

    <footer class="py-6 bg-gray-100">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-500 text-sm">&copy; 2025 Pedro Ureña. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Confeti -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const colors = ['#3b82f6', '#ec4899', '#f59e0b', '#10b981', '#6366f1'];

            function createConfetti() {
                const confetti = document.createElement('div');
                confetti.style.position = 'fixed';
                confetti.style.width = '10px';
                confetti.style.height = '10px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.borderRadius = '50%';
                confetti.style.left = Math.random() * window.innerWidth + 'px';
                confetti.style.top = '-10px';
                confetti.style.zIndex = '9999';
                confetti.style.opacity = '0.7';
                document.body.appendChild(confetti);

                const duration = Math.random() * 3 + 2;

                confetti.animate([{
                        transform: `translateY(0) rotate(0deg)`,
                        opacity: 0.7
                    },
                    {
                        transform: `translateY(${window.innerHeight + 100}px) rotate(${Math.random() * 360}deg)`,
                        opacity: 0
                    }
                ], {
                    duration: duration * 1000,
                    easing: 'cubic-bezier(0.1, 0.8, 0.9, 1)'
                });

                setTimeout(() => confetti.remove(), duration * 1000);
            }

            for (let i = 0; i < 50; i++) {
                setTimeout(createConfetti, i * 100);
            }

            document.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute('href') !== '#') {
                        for (let i = 0; i < 30; i++) {
                            setTimeout(createConfetti, i * 50);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
