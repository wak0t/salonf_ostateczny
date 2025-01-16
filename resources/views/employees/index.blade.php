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
                if (body.style.fontSize === '200%') {
                    body.style.fontSize = '';
                    buttons.forEach(button => button.style.fontSize = '');
                } else {
                    body.style.fontSize = '200%';
                    buttons.forEach(button => button.style.fontSize = '36px');
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
        .dashboard.dark-mode {
            background-color: #2a2a2a;
            color: #ffffff;
        }
        .dashboard.dark-mode h1 {
            color: #ffffff;
        }
        .dashboard.dark-mode .stats .stat {
            background-color: rgb(100, 0, 0);
        }
        .dark-mode button {
            background-color: #444;
            color: white;
        }
        button {
            padding: 10px;
            margin: 10px;
        }
        </style>
@extends('layouts.app')

@section('title', 'Lista Pracowników')

@section('content')
    <div class="container">
        <h1>Lista Pracowników</h1>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Imię</th>
                    <th>Email</th>
                    <th>Telefon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="position-fixed bottom-0 end-0 m-3">
    <button id="toggle-dark-mode" class="btn btn-primary mb-2">Tryb nocny</button>
    <button id="toggle-font-size" class="btn btn-secondary">Zwiększ czcionkę</button>
</div>
    </div>
@endsection
