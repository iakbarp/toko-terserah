<?php

namespace App;

use App\Models\Bio;
use App\Models\SocialProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeByActivationColumns(Builder $builder, $useremail, $verifyToken)
    {
        return $builder->where('email', $useremail)->orwhere('username', $useremail)
            ->where('verifyToken', $verifyToken);
    }

    public function socialProviders()
    {
        return $this->hasMany(SocialProvider::class, 'user_id');
    }

    public function getBio()
    {
        return $this->hasOne(Bio::class, 'user_id');
    }

    /**
     * Sends the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPassword($token));
    }
}

class CustomPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        $token = $this->token;
        $email = $notifiable->getEmailForPasswordReset();
        return (new MailMessage)
            ->from(env('MAIL_USERNAME'), env('APP_TITLE'))
            ->subject("Akun " . env('APP_NAME') . ": Reset Kata Sandi")
            ->view('emails.auth.reset', compact('token', 'email'));
    }
}