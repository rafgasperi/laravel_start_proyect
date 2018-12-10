<?php

namespace App;

use Cartalyst\Sentinel\Sentinel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends BaseModel
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','username', 'password','first_name','last_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $loginNames = ['username','email'];

    /**
     * Always Store Hashed passwords
     * @param [type] $password [description]
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function isOnGroup($group_name)
    {
        $sentryUser = Sentinel::findUserById($this->id);
        $group = Sentinel::findRoleByName($group_name);
        return $sentryUser->inRole($group);
    }

    public function getFullName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function roles(){
        return $this->belongsToMany('\App\Role','role_users');
    }

    public function getApiData()
    {
        $model = $this->all();
        return response()
            ->json([
                'model' => $model,
                'orderables' => [
                    ['title'=> 'Id', 'name'=> 'id'],
                    ['title'=> 'First Name', 'name'=> 'first_name'],
                    ['title'=> 'Last Name', 'name'=> 'last_name'],
                    ['title'=> 'Email', 'name'=> 'email'],
                ],
                'filterGroups' =>[
                   'name'=>'Usuarios',
                   'filters'=> [
                                   ['title'=> 'Id', 'name'=> 'id', 'type'=> 'numeric'],
                                   ['title'=> 'First Name', 'name'=> 'first_name', 'type'=> 'string'],
                                   ['title'=> 'Last Name', 'name'=> 'last_name', 'type'=> 'string'],
                                   ['title'=> 'Email', 'name'=> 'email', 'type'=> 'string'],
                                   ['title'=> 'Created At', 'name'=> 'created_at', 'type'=> 'datetime'],
                               ]
                ],
            ]);
    }
}
