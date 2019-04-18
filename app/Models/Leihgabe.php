<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leihgabe extends Model
{
  protected $connection = 'nasmysql';
  protected $table = 'Leihliste';
  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
