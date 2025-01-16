<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'user_id'];

    /**
     * Relacja z użytkownikiem (User).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relacja z wizytami (Appointments).
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'employee_id');
    }

    /**
     * Relacja z użytkownikiem przez email (opcjonalna).
     */
    public function userByEmail()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
