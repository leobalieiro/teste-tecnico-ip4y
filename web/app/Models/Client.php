<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $fillable = [
        'cpf',
        'first_name',
        'last_name',
        'birth_date',
        'email',
        'gender',
    ];

    public function setCpfAttribute($value)
    {
        // Remove caracteres não numéricos
        $this->attributes['cpf'] = preg_replace('/\D/', '', $value);
    }
}
