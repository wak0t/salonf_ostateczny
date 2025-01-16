@extends('layouts.app')

@section('title', 'Wizyty')

@section('content')
    <div class="container">
        <h1>Wizyty na dzień: {{ $date }}</h1>

        <form method="GET" action="{{ route('employee.appointments') }}" class="mb-3">
            <label for="date">Wybierz datę:</label>
            <input type="date" name="date" id="date" value="{{ $date }}" class="form-control" onchange="this.form.submit()">
        </form>

        @if ($appointments->isEmpty())
            <p>Brak wizyt na wybrany dzień.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Godzina</th>
                        <th>Klient</th>
                        <th>Usługa</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('H:i') }}</td>
                            <td>{{ $appointment->user->name }}</td>
                            <td>{{ $appointment->service->name }}</td>
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
