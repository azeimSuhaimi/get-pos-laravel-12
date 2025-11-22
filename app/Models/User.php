<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Auth\Events\Registered;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function updateLastLogin($email)
    {
            // get date today for bill 
            $now = Carbon::now();
            $date = $now->format('d-m-Y');
            $time = $now->format('H:i:s');

            $user = user::where('email',$email)->first();
            $user->last_login = $now;
            $user->save();

            return true;
    }//end method

    public static function addUser($name,$email,$phone)
    {
        $now = Carbon::now();// get date today
        
        //store data to database 
        $user = new user;
        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        $user->password = Hash::make($email);
        $user->date_register = $now;
        $user->key = Str::random(32);
        $user->save();

        return $user;

    }//end method

}//end class
