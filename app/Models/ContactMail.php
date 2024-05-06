<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMail extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget_min',
        'budget_max',
        'company',
        'email',
        'firstName',
        'lastName',
        'message',
        'phoneNumber',
        'website',
    ];
}
