<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiaryEntry extends Model
{
  	protected $connection = 'nasmysql';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $touches = ['diary'];

    public function diary()
    {
    	return $this->belongsTo('\App\Models\Diary');
    }
}
