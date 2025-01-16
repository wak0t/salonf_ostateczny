@extends('layouts.app')

@section('title', 'Wizyty')

@section('content')
<h1 class="mb-4">Lista Wizyt</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Klient</th>
            <th>Pracownik</th>
            <th>Usługa</th>
            <th>Data</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($appointments as $appointment)
        <tr>
            <td>{{ $appointment->user->name }}</td>
            <td>{{ $appointment->employee->name }}</td>
            <td>{{ $appointment->service->name }}</td>
            <td>{{ $appointment->appointment_date }}</td>
            <td>{{ $appointment->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
