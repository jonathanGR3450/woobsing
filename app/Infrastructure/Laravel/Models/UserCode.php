<?php

namespace App\Infrastructure\Laravel\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Model;

class UserCode extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'code',
    ];
}
