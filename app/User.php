<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //Atributes
      protected $fillable = ['firstName', 'lastName', 'email', 'password','role',];
      protected $hidden = ['password', 'remember_token',];
      protected $primaryKey = 'idUser';

    //Relations
      public function departaments()
      {
          return $this->belongsToMany('App\Models\Departament', 'usersDepartaments', 'idUser', 'idDepartament');
      }

      // public function setPasswordAttribute($password)
      // {
      //     $this->attributes['password'] = bcrypt($password);
      // }
}
