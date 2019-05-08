<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
  protected $connection = 'nasmysql';
  protected $table = 'projects';
  use SoftDeletes;
  protected $dates = ['deleted_at'];

  public function diary()
  {
  	return $this->hasOne('\App\Models\Diary', 'id', 'diary_id');
  }

  public function wps()
  {
    return $this->hasMany('\App\Models\WP', 'project_id', 'id');
  }
}
