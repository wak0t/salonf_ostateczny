@extends('layouts.app')

@section('title', 'Panel Pracownika')

@section('content')
    <div class="container">
        <h1>Panel Pracownika</h1>
        <p>Witaj, {{ $employee->name }}!</p>
        <a href="{{ route('employee.appointments') }}" class="btn btn-primary">Zobacz swoje wizyty</a>
    </div>
@endsection
