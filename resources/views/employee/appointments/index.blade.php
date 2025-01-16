@extends('layouts.app')

@section('title', 'Twoje Wizyty')

@section('content')
    <div class="container">
        <h1>Twoje Wizyty</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($appointments->isEmpty())
            <p>Brak zaplanowanych wizyt.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Godzina</th>
                        <th>Usługa</th>
                        <th>Klient</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('H:i') }}</td>
                            <td>{{ $appointment->service->name }}</td>
                            <td>{{ $appointment->user->name }}</td>
                            <td>
                                <form action="{{ route('employee.appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę wizytę?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
