<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
    </div>
    </nav>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButton = document.getElementById('toggle-dark-mode');
            const fontSizeButton = document.getElementById('toggle-font-size');
            const body = document.body;
            const loginContainer = document.querySelector('.login-container');
            const buttons = document.querySelectorAll('button, .btn-login, .btn-register');

            // Sprawdź, czy tryb nocny jest włączony
            if (localStorage.getItem('darkMode') === 'enabled') {
                body.classList.add('dark-mode');
                loginContainer.classList.add('dark-mode');
            }

            toggleButton.addEventListener('click', function () {
                if (body.classList.contains('dark-mode')) {
                    body.classList.remove('dark-mode');
                    loginContainer.classList.remove('dark-mode');
                    localStorage.setItem('darkMode', 'disabled');
                } else {
                    body.classList.add('dark-mode');
                    loginContainer.classList.add('dark-mode');
                    localStorage.setItem('darkMode', 'enabled');
                }
            });

            // Obsługa zwiększania czcionki i przycisków
            fontSizeButton.addEventListener('click', function () {
                if (body.style.fontSize === '200%') {
                    body.style.fontSize = '';
                    buttons.forEach(button => {
                        button.style.fontSize = '';
                        button.style.padding = '';
                    });
                    localStorage.setItem('fontSize', 'normal');
                } else {
                    body.style.fontSize = '200%';
                    buttons.forEach(button => {
                        button.style.fontSize = '28px';
                        button.style.padding = '25px 38px';
                    });
                    localStorage.setItem('fontSize', 'large');
                }
            });

            // Sprawdź, czy zwiększona czcionka jest włączona
            if (localStorage.getItem('fontSize') === 'large') {
                body.style.fontSize = '200%';
                buttons.forEach(button => {
                    button.style.fontSize = '36px';
                    button.style.padding = '30px 45px';
                });
            }
        });
    </script>

    <style>
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }

        .navbar.dark-mode {
            background-color: #1f1f1f !important;
        }

        .card.dark-mode {
            background-color: #2a2a2a;
            border-color: #444444;
        }

        .btn.dark-mode {
            background-color: #333333;
            color: #ffffff;
        }

        .btn.dark-mode:hover {
            background-color: #444444;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .login-container {
            max-width: 500px;
            margin: 100px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .login-container.dark-mode {
            background-color: #2a2a2a;
            color: #dddddd;
        }

        .login-container h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .login-container.dark-mode h1 {
            color: #ffffff;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            color: #555;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 95%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #007BFF;
        }

        .btn-login {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .btn-register {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-register:hover {
            background-color: #218838;
        }

        .error-message {
            color: #FF0000;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .success-message {
            color: #28a745;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .dark-mode-toggle {
            position: fixed;
            bottom: 120px;
            right: 20px;
            background-color: #007BFF;
            color: #fff;
            padding: 20px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 18px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        .dark-mode-toggle:hover {
            background-color: #0056b3;
        }

        .font-size-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #28a745;
            color: #fff;
            padding: 20px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 18px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        .font-size-toggle:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <button id="toggle-font-size" class="font-size-toggle">Zwiększ czcionkę</button>
    <button id="toggle-dark-mode" class="dark-mode-toggle">Tryb nocny</button>

    <div class="login-container">
        <h1>Logowanie</h1>

        @if (session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Hasło</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn-login">Zaloguj się</button>
        </form>
        <p class="text-center mt-3">Nie masz konta? <a href="{{ route('register-form') }}" class="btn-register">Zarejestruj się</a></p>
    </div>
</body>
</html>
