<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diary extends Model
{
  	protected $connection = 'nasmysql';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $touches = ['project'];

    public function entries()
    {
    	return $this->hasMany('\App\Models\DiaryEntry');
    }

    public function project()
    {
    	return $this->hasOne('\App\Models\Project', 'diary_id', 'id');
    }
}
