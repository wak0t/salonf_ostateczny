<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Employee;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['client', 'employee', 'service'])->get();
        $employees = Employee::all();
        return view('admin.appointments.index', compact('appointments', 'employees'));
    }

    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->back()->with('error', 'Nie znaleziono wizyty do usunięcia.');
        }

        $appointment->delete();

        return redirect()->back()->with('success', 'Wizyta została pomyślnie usunięta.');
    }
}
