<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Employee;

class ClientController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['service', 'employee'])->where('user_id', auth()->id())->get();
        return view('client.appointments.index', compact('appointments'));
    }

    public function showAppointments()
    {
        $appointments = Appointment::with(['service', 'employee'])->where('user_id', Auth::id())->get();
        return view('client.appointments.index', compact('appointments'));
    }

    public function createAppointment(Request $request)
    {
        $services = Service::all();
        $employees = Employee::all();

        // Jeśli jest to żądanie AJAX, zwracamy dostępne godziny
        if ($request->ajax() && $request->date && $request->employee_id) {
            $timeSlots = $this->generateAvailableTimeSlots($request->date, $request->employee_id);
            return response()->json(['timeSlots' => $timeSlots]);
        }

        // Dla standardowego widoku
        $timeSlots = $this->generateAvailableTimeSlots();
        return view('client.appointments.create', compact('services', 'employees', 'timeSlots'));
    }

    public function storeAppointment(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required|in:' . implode(',', $this->generateAvailableTimeSlots($request->appointment_date, $request->employee_id)),
            'employee_id' => 'required|exists:employees,id',
        ]);

        // Łączenie daty i godziny
        $appointmentDateTime = $request->appointment_date . ' ' . $request->appointment_time . ':00';

        Appointment::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'appointment_date' => $appointmentDateTime,
            'employee_id' => $request->employee_id,
        ]);

        return redirect()->route('client.appointments.index')->with('success', 'Wizyta została zaplanowana.');
    }

    private function generateAvailableTimeSlots($date = null, $employeeId = null)
    {
        $timeSlots = [];
        for ($hour = 9; $hour < 16; $hour++) {
            foreach ([0, 30] as $minute) {
                if ($hour == 15 && $minute == 30) {
                    break; // Ostatnia dostępna godzina to 15:30
                }
                $timeSlots[] = sprintf('%02d:%02d', $hour, $minute);
            }
        }

        if ($date && $employeeId) {
            $bookedSlots = Appointment::whereDate('appointment_date', $date)
                ->where('employee_id', $employeeId)
                ->pluck('appointment_date')
                ->map(function ($dateTime) {
                    return date('H:i', strtotime($dateTime));
                })->toArray();

            $timeSlots = array_filter($timeSlots, function ($timeSlot) use ($bookedSlots) {
                $timeSlotTimestamp = strtotime($timeSlot);
                foreach ($bookedSlots as $booked) {
                    $bookedTimestamp = strtotime($booked);
                    if ($timeSlotTimestamp >= $bookedTimestamp && $timeSlotTimestamp < strtotime('+1 hour', $bookedTimestamp)) {
                        return false;
                    }
                }
                return true;
            });
        }

        return array_values($timeSlots);
    }

    public function editAppointment(Appointment $appointment)
    {
        $this->authorize('update', $appointment);
        $services = Service::all();
        $employees = Employee::all();
        $timeSlots = $this->generateAvailableTimeSlots($appointment->appointment_date, $appointment->employee_id);
        return view('client.appointments.edit', compact('appointment', 'services', 'employees', 'timeSlots'));
    }

    public function updateAppointment(Request $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required|in:' . implode(',', $this->generateAvailableTimeSlots($request->appointment_date, $request->employee_id)),
            'employee_id' => 'required|exists:employees,id',
        ]);

        // Łączenie daty i godziny
        $appointmentDateTime = $request->appointment_date . ' ' . $request->appointment_time . ':00';

        $appointment->update([
            'service_id' => $request->service_id,
            'appointment_date' => $appointmentDateTime,
            'employee_id' => $request->employee_id,
        ]);

        return redirect()->route('client.appointments.index')->with('success', 'Wizyta została zaktualizowana.');
    }

    public function destroyAppointment(Appointment $appointment)
    {
        //$this->authorize('delete', $appointment);

        $appointment->delete();

        return redirect()->route('client.appointments.index')->with('success', 'Wizyta została anulowana.');
    }
}
