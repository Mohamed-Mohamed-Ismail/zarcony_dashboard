<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, LogsActivity;
    protected $table ="users";
    protected static $logName = "user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','balance'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} user";
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment','user_id');
    }

//    public function getUserInTransaction()
//    {
//        $inTransaction = Payment::where('recipient_id',$this->id)->get();
//        if($inTransaction){
//            return $inTransaction;
//        }
//        else{
//             return $inTransaction =[];
//        }
//    }
}
