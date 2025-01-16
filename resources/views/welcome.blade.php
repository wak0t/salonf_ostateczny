<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButton = document.getElementById('toggle-dark-mode');
            const fontSizeButton = document.getElementById('toggle-font-size');
            const body = document.body;
            const buttons = document.querySelectorAll('button');
            const header = document.querySelector('header');
            const main = document.querySelector('main');
            const dashboard = document.querySelector('.dashboard');

            if (localStorage.getItem('darkMode') === 'enabled') {
                body.classList.add('dark-mode');
                header.classList.add('dark-mode');
                main.classList.add('dark-mode');
                if (dashboard) dashboard.classList.add('dark-mode');
            }

            toggleButton.addEventListener('click', function () {
                if (body.classList.contains('dark-mode')) {
                    body.classList.remove('dark-mode');
                    header.classList.remove('dark-mode');
                    main.classList.remove('dark-mode');
                    if (dashboard) dashboard.classList.remove('dark-mode');
                    localStorage.setItem('darkMode', 'disabled');
                } else {
                    body.classList.add('dark-mode');
                    header.classList.add('dark-mode');
                    main.classList.add('dark-mode');
                    if (dashboard) dashboard.classList.add('dark-mode');
                    localStorage.setItem('darkMode', 'enabled');
                }
            });

            fontSizeButton.addEventListener('click', function () {
                const headings = document.querySelectorAll('h1, p');
                if (body.style.fontSize === '200%') {
                    body.style.fontSize = '';
                    buttons.forEach(button => button.style.fontSize = '');
                headings.forEach(heading => heading.style.fontSize = '');
                } else {
                    body.style.fontSize = '200%';
                    buttons.forEach(button => button.style.fontSize = '28px');
                headings.forEach(heading => heading.style.fontSize = '40px');
                }
            });
        });
    </script>
    <style>
        body.dark-mode {
        background-color: #121212;
        color: white;
        }
        header.dark-mode {
            background-color: #1f1f1f;
            color: #ffffff;
        }
        main.dark-mode {
            background-color: #1f1f1f;
            color: #ffffff;
        }
        .dashboard {
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .dashboard.dark-mode {
            background-color: #2a2a2a;
            color: #ffffff;
        }
        .dashboard h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .dashboard.dark-mode h1 {
            color: #ffffff;
        }
        .dashboard .stats {
            display: flex;
            justify-content: space-around;
        }
        .dashboard .stats .stat {
            text-align: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: rgb(255, 0, 0);
        }
        .dashboard.dark-mode .stats .stat {
            background-color: rgb(100, 0, 0);
        }
        button {
            padding: 10px;
            margin: 10px;
        }
        .dark-mode button {
            background-color: #444;
            color: white;
        }
        
    </style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Fryzjerski</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container text-center mt-5">
        <h1>Witamy w Systemie Rezerwacji Salon Fryzerski!</h1>
        <p class="lead">Zarezerwuj swoją wizytę już dziś i ciesz się profesjonalną obsługą!</p>
        <a href="{{ route('login-form') }}" class="btn btn-primary">Zaloguj się aby zobaczyć dostępne wizyty</a>
        <a href="{{ route('register-form') }}" class="btn btn-primary">Zarejestruj się</a>
    </div>
    <div class="position-fixed bottom-0 end-0 m-3">
    <button id="toggle-dark-mode" class="btn btn-primary mb-2">Tryb nocny</button>
    <button id="toggle-font-size" class="btn btn-secondary">Zwiększ czcionkę</button>
</div>

</body>
</html>
