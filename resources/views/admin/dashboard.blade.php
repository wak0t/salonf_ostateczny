<style>
    .dashboard {
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .dashboard h1 {
        color: #333;
        margin-bottom: 20px;
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

    body.dark-mode {
        background-color: #121212;
        color:rgb(0, 0, 0);
    }

    .dark-mode .dashboard {
        background-color: #333333;
                color: #ffffff;
    }

    button {
        margin: 10px;
        padding: 10px 20px;
    }

    .dark-mode button {
        color: #ffffff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('toggle-dark-mode');
        const fontSizeButton = document.getElementById('toggle-font-size');
        const body = document.body;
        const buttons = document.querySelectorAll('button');

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
            if (body.style.fontSize === '200%') {
                body.style.fontSize = '';
                buttons.forEach(button => button.style.fontSize = '');
            } else {
                body.style.fontSize = '200%';
                buttons.forEach(button => button.style.fontSize = '28px');
            }
        });
    });
</script>

@extends('layouts.app')

@section('title', 'Panel Administratora')

@section('content')
<div class="container">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <h1>Panel Administratora</h1>
        <div>
            <button id="toggle-dark-mode" class="btn btn-primary">Tryb nocny</button>
            <button id="toggle-font-size" class="btn btn-secondary">Zwiększ czcionkę</button>
        </div>
    </header>
    <p>Witaj w panelu administratora!</p>
    <ul>
        <li><a href="{{ route('admin.appointments') }}">Wszystkie wizyty</a></li>
    </ul>

    <a href="{{ route('admin.add-employee') }}" class="btn btn-primary">Dodaj Pracownika</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Imię i nazwisko</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->phone }}</td>
            <td>
                <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
