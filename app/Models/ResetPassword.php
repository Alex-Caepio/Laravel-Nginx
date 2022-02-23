<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;



    public static function where(string $string, $email)
    {
    }

    public function user()
    {
       //return $this->belongsTo(User::class);
    }
}
