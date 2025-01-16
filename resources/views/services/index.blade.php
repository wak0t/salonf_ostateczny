<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('toggle-dark-mode');
        const fontSizeButton = document.getElementById('toggle-font-size');
        const body = document.body;
        const buttons = document.querySelectorAll('button, a.btn');
        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
        }

        toggleButton.addEventListener('click', function () {
            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                localStorage.setItem('darkMode', 'disabled');
            } else {
                body.classList.add('dark-mode');
                localStorage.setItem('darkMode', 'enabled');
            }
        });

        fontSizeButton.addEventListener('click', function () {
            const tableHeaders = document.querySelectorAll('th');
            const tableData = document.querySelectorAll('td');
            const headings = document.querySelectorAll('h1');
            const table = document.querySelector('table');
            if (body.style.fontSize === '200%') {
                body.style.fontSize = '';
                buttons.forEach(button => button.style.fontSize = '');
                tableHeaders.forEach(th => th.style.fontSize = '');
                tableData.forEach(td => td.style.fontSize = '');
                headings.forEach(h1 => h1.style.fontSize = '');
                if (table) table.style.fontSize = '';
            } else {
                body.style.fontSize = '200%';
                buttons.forEach(button => button.style.fontSize = '28px');
                tableHeaders.forEach(th => th.style.fontSize = '150%');
                tableData.forEach(td => td.style.fontSize = '150%');
                headings.forEach(h1 => h1.style.fontSize = '150%');
            }
        });
    });
</script>
    <style>
        body.dark-mode {
        background-color: #121212;
        color: #000;
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
            background-color: red;
            color: white;
        }

        button {
            background-color: blue;
            color: white;
        }
    </style>
@extends('layouts.app')

@section('title', 'Usługi')

@section('content')
<h1 class="mb-4">Lista Usług</h1>
<div class="position-fixed bottom-0 end-0 m-3">
        <button id="toggle-dark-mode" class="btn btn-primary mb-2">Tryb nocny</button>
        <button id="toggle-font-size" class="btn btn-secondary">Zwiększ czcionkę</button>
    </div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nazwa</th>
            <th>Cena</th>
            <th>Czas trwania</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($services as $service)
        <tr>
            <td>{{ $service->name }}</td>
            <td>{{ $service->price }} zł</td>
            <td>{{ $service->duration }} minut</td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
