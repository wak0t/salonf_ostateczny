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
                    buttons.forEach(button => button.style.fontSize = '36px');
                }
            });
        });
    </script>


@extends('layouts.app')

<style>
        body.dark-mode {
            background-color: #121212;
            color: #000;
        }

        .dark-mode button {
            background-color: #444;
            color: white;
        }

    </style>

@section('title', 'Dodaj Pracownika')

@section('content')
<div class="container">
    <h1>Dodaj Nowego Pracownika</h1>
    <form action="{{ route('admin.employees.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Imię i nazwisko</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Hasło</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Numer telefonu</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj Pracownika</button>
    </form>
    <br>
    <a href="{{ url('/admin') }}" class="btn btn-secondary">Powrót</a>
    <div>
            <button id="toggle-dark-mode" class="btn btn-primary">Tryb nocny</button>
            <button id="toggle-font-size" class="btn btn-secondary">Zwiększ czcionkę</button>
        </div>
</div>
@endsection
