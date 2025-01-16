<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Models\Appointment;
use Exception;

class AdminController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $appointments = Appointment::with(['client', 'employee', 'service'])->get();
        return view('admin.dashboard', compact('employees', 'appointments'));
    }

    public function storeEmployee(Request $request)
    {
        try {
            // Testowy zapis użytkownika
            $testUser = User::create([
                'name' => 'Test User',
                'email' => 'test@user.com',
                'password' => bcrypt('password123'),
                'role_id' => 2,
            ]);

            if ($testUser) {
                \Log::info('Testowy użytkownik dodany:', $testUser->toArray());
            } else {
                \Log::error('Nie udało się dodać testowego użytkownika.');
                return redirect()->back()->with('error', 'Nie udało się dodać testowego użytkownika.');
            }

            // Usunięcie testowego użytkownika po weryfikacji
            $testUser->delete();
            \Log::info('Testowy użytkownik został usunięty po weryfikacji.');

            // Walidacja danych wejściowych
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|unique:employees,email',
                'password' => 'required|string',
                'phone' => 'required|string',
            ]);

            \Log::info('Dane pracownika walidacja przeszła pomyślnie:', $validated);

            // Dodanie do tabeli users
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'role_id' => 2, // Załóżmy, że rola pracownika to ID 2
            ]);

            if (!$user) {
                \Log::error('Nie udało się dodać użytkownika.');
                return redirect()->back()->with('error', 'Nie udało się dodać użytkownika.');
            }

            \Log::info('Użytkownik dodany:', $user->toArray());

            // Dodanie do tabeli employees
            $employee = Employee::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'user_id' => $user->id,
            ]);

            if (!$employee) {
                \Log::error('Nie udało się dodać pracownika.');
                return redirect()->back()->with('error', 'Nie udało się dodać pracownika.');
            }

            \Log::info('Pracownik dodany:', $employee->toArray());

            return redirect()->back()->with('success', 'Pracownik został pomyślnie dodany.');
        } catch (Exception $e) {
            \Log::error('Wystąpił wyjątek podczas dodawania pracownika:', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Wystąpił błąd podczas dodawania pracownika. Skontaktuj się z administratorem.');
        }
    }

    public function destroyAppointment($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->back()->with('error', 'Nie znaleziono wizyty do usunięcia.');
        }

        $appointment->delete();

        return redirect()->back()->with('success', 'Wizyta została pomyślnie usunięta.');
    }

    public function addEmployeeView()
    {
        return view('admin.add-employee');
    }

    public function destroyEmployee($id)
    {
        $employee = Employee::find($id);
    
        if (!$employee) {
            return redirect()->back()->with('error', 'Nie znaleziono pracownika do usunięcia.');
        }
    
        // Usunięcie powiązanego użytkownika
        $user = $employee->user;
        if ($user) {
            $user->delete();
        }
    
        $employee->delete();
    
        return redirect()->back()->with('success', 'Pracownik został pomyślnie usunięty.');
    }
    
}
