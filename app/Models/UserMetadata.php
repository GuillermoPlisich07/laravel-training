<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserMetadata extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'user_metadata';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }
}
