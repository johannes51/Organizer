<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
  protected $connection = 'lifemysql';
  protected $table = 'loans';
  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
