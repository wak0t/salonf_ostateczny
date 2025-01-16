<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'employee_id', 'service_id', 'appointment_date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Klient
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id'); // Alternatywa dla `user`
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function scopeByEmployee($query, $employeeId)
    {
        return $query->where('employee_id', $employeeId);
    }
}
