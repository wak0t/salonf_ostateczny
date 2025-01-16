@extends('layouts.app')

@section('title', 'Wszystkie Wizyty')

@section('content')
<div class="container">
    <h1>Wszystkie Wizyty</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($appointments->isEmpty())
        <p>Brak wizyt do wyświetlenia.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Godzina</th>
                    <th>Klient</th>
                    <th>Usługa</th>
                    <th>Pracownik</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>{{ $appointment->client->name }}</td>
                        <td>{{ $appointment->service->name }}</td>
                        <td>{{ $appointment->employee->name }}</td>
                        <td>
                            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Czy na pewno chcesz usunąć tę wizytę?')">Usuń</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
