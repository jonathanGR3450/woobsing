<?php

namespace App\Infrastructure\Laravel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
