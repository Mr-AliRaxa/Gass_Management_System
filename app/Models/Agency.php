<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone', 'status'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function setting()
    {
        return $this->hasOne(AgencySetting::class);
    }
}
