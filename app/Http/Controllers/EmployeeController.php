<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Employee;


class EmployeeController extends Controller
{
    public function index()
    {
        // Panel pracownika
        return view('employee.dashboard', ['employee' => Auth::user()]);
    }

    public function showAppointments()
    {
        $employee = Employee::where('user_id', Auth::id())->first();

        if (!$employee) {
            dd('Nie znaleziono pracownika z user_id: ' . Auth::id());
        }
        
    
        $appointments = Appointment::where('employee_id', $employee->id)->get();
        return view('employee.appointments.index', compact('appointments'));
    }
    
    

    public function destroyAppointment(Appointment $appointment)
    {
        // Sprawdź, czy wizyta należy do zalogowanego pracownika
        if ($appointment->employee_id !== Auth::id()) {
            abort(403, 'Nie masz uprawnień do usunięcia tej wizyty.');
        }

        $appointment->delete();

        return redirect()->route('employee.appointments')->with('success', 'Wizyta została usunięta.');
    }
}

