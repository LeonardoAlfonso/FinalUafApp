<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Glossary extends Model
{
  //Attributes
    protected $table = "glossary";
    protected $fillable = ['group','word','definition'];
    protected $primaryKey = 'idWord';
}
