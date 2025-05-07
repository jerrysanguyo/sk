<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;
    protected $table = 'event_registrations';
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_number'
    ];

    public static function getAllRegistered()
    {
        return self::all();
    }
}
