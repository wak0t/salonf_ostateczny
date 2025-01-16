@extends('layouts.admin')

@section('content')
<h1>Zarządzanie pracownikami</h1>

<!-- Formularz dodawania -->
<form action="{{ route('admin.employees.add') }}" method="POST">
    @csrf
    <div>
        <label for="name">Imię</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div>
        <label for="password">Hasło</label>
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit">Dodaj pracownika</button>
</form>

<hr>

<!-- Lista pracowników -->
<h2>Lista pracowników</h2>
<table>
    <thead>
        <tr>
            <th>Imię</th>
            <th>Email</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
        <tr>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>
                <form action="{{ route('admin.employees.delete', $employee->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Na pewno usunąć tego pracownika?')">Usuń</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
