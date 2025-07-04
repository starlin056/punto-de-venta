<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Inicio de sesión del sistema" />
    <meta name="author" content="SakCode" />
    <title>Sistema de ventas - Login</title>

    {{-- Enlaces de fuentes y librerías --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v6.5.1/css/all.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        :root {
            --background-color: #151f28;
            --box-inner-bg: #2d2d39;
            --input-bg: #0000001a;
            --input-border-color: #fff;
            --text-color: #fff;
            --alert-bg: #2d2d39;
        }

        body.light-mode {
            --background-color: rgb(216, 215, 215);
            --box-inner-bg: #ffffff;
            --input-bg: rgb(218, 213, 213);
            --input-border-color: #333;
            --text-color: #000;
            --alert-bg: rgb(225, 222, 222);
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: var(--background-color);
            transition: background 0.5s;
            flex-direction: column;
        }

        * {
            font-family: "Poppins", sans-serif;
        }

        @property --a {
            syntax: "<angle>";
            inherits: false;
            initial-value: 0deg;
        }

        .box {
            position: relative;
            width: 400px;
            height: 320px;
            background: repeating-conic-gradient(
                from var(--a),
                #ff2770 0%,
                #ff2770 5%,
                transparent 5%,
                transparent 40%,
                #ff2770 50%
            );
            filter: drop-shadow(0 15px 50px #000);
            border-radius: 20px;
            animation: rotating 42s linear infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.5s;
            margin-top: 20px;
        }

        @keyframes rotating {
            0% { --a: 0deg; }
            100% { --a: 360deg; }
        }

        .box::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: repeating-conic-gradient(
                from var(--a),
                #45f3ff 0%,
                #45f3ff 5%,
                transparent 5%,
                transparent 40%,
                #45f3ff 50%
            );
            filter: drop-shadow(0 15px 50px #000);
            border-radius: 20px;
            animation: rotating 4s linear infinite;
            animation-delay: -1s;
        }

        .box::after {
            content: "";
            position: absolute;
            inset: 4px;
            background: var(--box-inner-bg);
            border-radius: 15px;
            border: 8px solid #25252b;
        }

        .box:hover {
            width: 450px;
            height: 500px;
        }

        .box:hover .login {
            inset: 40px;
        }

        .box:hover .loginBx {
            transform: translateY(0px);
        }

        .login {
            position: absolute;
            inset: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border-radius: 10px;
            background: #00000033;
            color: var(--text-color);
            z-index: 1000;
            box-shadow: inset 0 10px 20px #00000080;
            border-bottom: 2px solid #ffffff80;
            transition: 0.5s;
            overflow: hidden;
        }

        .loginBx {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 20px;
            width: 70%;
            transform: translateY(126px);
            transition: 0.5s;
        }

        h2 {
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.2em;
        }

        h2 i {
            color: #ff2770;
            text-shadow: 0 0 5px #ff2770, 0 0 20px #ff2770;
        }

        input {
            width: 100%;
            padding: 10px 20px;
            outline: none;
            border: 2px solid var(--input-border-color);
            background: var(--input-bg);
            font-size: 1em;
            color: var(--text-color);
            border-radius: 30px;
            transition: background 0.3s, color 0.3s, border-color 0.3s;
        }

        input::placeholder {
            color: #999;
        }

        input[type="submit"] {
            background: #45f3ff;
            border: none;
            font-weight: 500;
            color: #111;
            cursor: pointer;
            transition: 0.5s;
        }

        input[type="submit"]:hover {
            box-shadow: 0 0 10px #45f3ff, 0 0 60px #45f3ff;
        }

        .group {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .group a {
            color: var(--text-color);
            text-decoration: none;
            font-size: 0.9em;
        }

        .group a:nth-child(2) {
            color: #ff2770;
            font-weight: 600;
        }

        .alert {
            background: var(--alert-bg);
            color: var(--text-color);
        }

        .theme-toggle-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #45f3ff;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: bold;
            cursor: pointer;
            color: #111;
            box-shadow: 0 0 10px #45f3ff, 0 0 20px #45f3ff;
            transition: background 0.3s;
            z-index: 9999;
        }

        .theme-toggle-btn:hover {
            background: #1dcbe6;
            box-shadow: 0 0 15px #1dcbe6, 0 0 30px #1dcbe6;
        }
    </style>
</head>

<body>
    <button id="toggleTheme" class="theme-toggle-btn">Modo Claro</button>

    <div class="box">
        <div class="login">
            <form class="loginBx" action="{{ route('login.login') }}" method="post">
                @csrf
                <h2>
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Acceso
                    <i class="fa-solid fa-gem"></i>
                </h2>

                @if ($errors->any())
                    @foreach ($errors->all() as $item)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 1.0em;">
                            {{$item}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif

                <input type="email" name="email" value="" placeholder="Correo electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <input type="submit" value="Iniciar sesión">
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script>
        const toggleBtn = document.getElementById('toggleTheme');

        toggleBtn.addEventListener('click', function () {
            document.body.classList.toggle('light-mode');
            if (document.body.classList.contains('light-mode')) {
                toggleBtn.textContent = 'Modo Oscuro';
            } else {
                toggleBtn.textContent = 'Modo Claro';
            }
        });
    </script>
</body>

</html>
