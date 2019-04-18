<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
  protected $connection = 'nasmysql';
  protected $table = 'Filme';
  public $timestamps = false;
}
