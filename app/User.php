<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Model\request_document as request_document;

use App\Model\user_notification as user_notification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name', 'email', 'password',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

        'password', 'remember_token',

    ];

    public function MyRequest()
    {

        return $this->belongsTo( request_document::class, 'user_id' , 'user_id' );

    }

    public function myNotification()
    {

        return $this->hasMany( user_notification::class, 'user_id' , 'user_id' );

    }

}
