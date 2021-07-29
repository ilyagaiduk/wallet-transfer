<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getUsers() {
        $users = DB::table('users')
                ->get();
        return $users;
    }
    public function getUser($id) {
        $user = DB::table('users')
            ->where('id', '=', $id)
            ->first();
        return $user;
    }
    public function getUsersForTransfer($id) {
        $users = DB::table('users')
            ->where('id', '!=', $id)
            ->get();
        return $users;
    }
    public function balance()
    {
        return $this->hasOne(Balance::class);
    }

}
