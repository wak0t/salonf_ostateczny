<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Fryzjerski</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-right {
            text-align: right;
        }
        .login-button {
            background-color: #ff6600;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .login-button:hover {
            background-color: #e65c00;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            color: #333;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f9f9f9;
        }
    </style>
</head>
<body>
    <header>
        <h1>Witamy w naszym Salonie Fryzjerskim!</h1>
        <div class="header-right">
            <a href="{{ route('login-form') }}" class="login-button">Zaloguj się</a>
        </div>
    </header>
    <div class="container">
        <div class="section">
            <h2>O naszym salonie</h2>
            <p>Zapraszamy do naszego salonu fryzjerskiego, gdzie profesjonalizm spotyka się z pasją. Oferujemy szeroką gamę usług dla każdego klienta!</p>
        </div>
        <div class="section">
            <h2>Nasze usługi</h2>
            <ul>
                @foreach ($services as $service)
                    <li>{{ $service->name }} - {{ $service->price }} PLN</li>
                @endforeach
            </ul>
        </div>
        <div class="section">
            <h2>Nasi pracownicy</h2>
            <ul>
                @foreach ($employees as $employee)
                    <li>{{ $employee->name }} - Specjalizacja: {{ $employee->specialization }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>
