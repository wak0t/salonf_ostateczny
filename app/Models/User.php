<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Pola, które mogą być masowo wypełniane.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * Pola, które mają być ukryte w tablicach i JSON-ie.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Rzutowania atrybutów na typy danych.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relacja: użytkownik należy do roli.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relacja: użytkownik ma wiele wizyt.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Relacja: użytkownik ma wiele recenzji.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Relacja: użytkownik ma wiele powiadomień.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Relacja: użytkownik może być przypisany jako pracownik (optional).
     */
    public function employee()
    {
        return $this->hasOne(Employee::class, 'email', 'email');
    }
}