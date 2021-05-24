<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'hora_comienzo',
        'hora_fin',
        'email_company'
    ];
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
