<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    //Atributes
      protected $fillable = ['firstName', 'lastName', 'fullName', 'email', 'password','role',];
      protected $hidden = ['password', 'remember_token',];
      protected $primaryKey = 'idUser';

    //Relations
      public function departaments()
      {
          return $this->belongsToMany('App\Models\Departament', 'usersDepartaments', 'idUser', 'idDepartament');
      }

      public function getFullNameAttribute()
      {
          return "{$this->firstName} {$this->lastName}";
      }

      public function setPasswordAttribute($password)
      {
          $this->attributes['password'] = bcrypt($password);
      }
}
