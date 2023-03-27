<?php

namespace App\Infrastructure\Laravel\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Mail\SendCodeMail;
use App\Notifications\VerifyEmailNotification;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role_id',
        'password',
        'email_verified_at',
        'last_session',
        'verification_token',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_session' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function getEmailForVerification()
    {
        return $this->email;
    }

    public function hasVerifiedEmail()
    {
        return $this->email_verified_at !== null;
    }

    public function markEmailAsVerified()
    {
        $this->email_verified_at = $this->freshTimestamp();
        $this->verification_token = null;
        return $this->save();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function generateCode()
    {
        $code = rand(1000, 9999);

        UserCode::updateOrCreate(
            [ 'user_id' => auth()->user()->id ],
            [ 'code' => $code ]
        );

        try {
            $details = [
                'title' => 'Mail from woobsing.com',
                'code' => $code
            ];

            Mail::to(auth()->user()->email)->send(new SendCodeMail($details));
        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }
}
