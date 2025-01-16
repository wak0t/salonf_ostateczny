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

@section('content')
<div>
            <button id="toggle-dark-mode" class="btn btn-primary">Tryb nocny</button>
            <button id="toggle-font-size" class="btn btn-secondary">Zwiększ czcionkę</button>
        </div>
    <h1>Panel Klienta</h1>
    <p>Witaj, {{ Auth::user()->name }}!</p>
    <a href="{{ route('client.appointments') }}">Zarządzaj wizytami</a>
@endsection

@extends('layouts.app')
