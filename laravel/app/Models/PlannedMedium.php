<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlannedMedium extends Model
{
  protected $connection = 'lifemysql';
  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
