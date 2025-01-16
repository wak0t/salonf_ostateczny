<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utwórz Wizytę</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<div class="position-fixed bottom-0 end-0 m-3">
    <button id="toggle-dark-mode" class="btn btn-primary mb-2">Tryb nocny</button>
    <button id="toggle-font-size" class="btn btn-secondary">Zwiększ czcionkę</button>
</div>


    <div class="container mt-5">
        <h1>Utwórz Wizytę</h1>

        <form action="{{ route('client.appointments.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="service_id">Wybierz usługę</label>
                <select name="service_id" id="service_id" class="form-control" required>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="appointment_date">Wybierz datę wizyty</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
            </div>

            <div class="form-group mt-3">
                <label for="employee_id">Wybierz pracownika</label>
                <select name="employee_id" id="employee_id" class="form-control" required>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="appointment_time">Wybierz godzinę wizyty</label>
                <select name="appointment_time" id="appointment_time" class="form-control" required>
                    <option value="">Najpierw wybierz datę i pracownika</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Zapisz</button>
            <div>
            <a href="http://127.0.0.1:8000/client" class="btn btn-secondary mt-3">Powrót</a>
            </div>

        </form>
    </div>

    <script>
        $(document).ready(function () {
            // Blokowanie wyboru soboty i niedzieli
            $('#appointment_date').on('input', function () {
                const selectedDate = new Date($(this).val());
                const day = selectedDate.getDay();
                if (day === 0 || day === 6) { // Niedziela (0) i Sobota (6)
                    alert('W soboty oraz niedziele salon jest nieczynny.');
                    $(this).val('');
                }
            });

            $('#appointment_date, #employee_id').on('change', function () {
                const date = $('#appointment_date').val();
                const employeeId = $('#employee_id').val();

                if (date && employeeId) {
                    $.ajax({
                        url: "{{ route('client.appointments.create') }}",
                        method: "GET",
                        data: { date: date, employee_id: employeeId },
                        success: function (response) {
                            $('#appointment_time').empty();
                            if (response.timeSlots && response.timeSlots.length > 0) {
                                response.timeSlots.forEach(function (time) {
                                    $('#appointment_time').append(`<option value="${time}">${time}</option>`);
                                });
                            } else {
                                $('#appointment_time').append('<option value="">Brak dostępnych godzin</option>');
                            }
                        }
                    });
                }
            });

            const toggleButton = document.getElementById('toggle-dark-mode');
            const fontSizeButton = document.getElementById('toggle-font-size');
            const body = document.body;

            toggleButton.addEventListener('click', function () {
                body.classList.toggle('dark-mode');
            });

            fontSizeButton.addEventListener('click', function () {
                if (body.style.fontSize === '200%') {
                    body.style.fontSize = '';
                } else {
                    body.style.fontSize = '200%';
                }
            });
        });
    </script>
    <style>
        body.dark-mode {
            background-color: #121212;
            color: white;
        }

        .dark-mode .form-control {
            background-color: #333;
            color: white;
        }

        .btn {
            font-size: 14px;
        }

        .dark-mode .btn {
            background-color: #555;
            color: white;
        }

        .position-fixed {
            z-index: 1000;
        }
    </style>
</body>
</html>
