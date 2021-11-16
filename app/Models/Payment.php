<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{
    use Filterable,LogsActivity;
    protected static $logName = "payment";

    protected static $logAttributes = ['payment_number', 'user_id','recipient_id','amount'];
    protected static $logOnlyDirty = true;

    protected $table ="payments";
    protected $fillable = [
        'payment_number', 'user_id', 'recipient_id','amount'
    ];
    public $timestamps = true;
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
    ];

//    public function getUserIdAttribute($val)
//    {
//
//        $user = User::find($val);
//        return  $user->name;
//
//    }
//    public function getRecipientIdAttribute($val)
//    {
//        $user = User::find($val);
//        return  $user->name;
//
//    }
    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} payment";
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
