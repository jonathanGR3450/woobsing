<?php

namespace App\Infrastructure\Laravel\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attempts_employed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'created_at',
        'updated_at',
    ];
}
