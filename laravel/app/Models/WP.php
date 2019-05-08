<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WP extends Model
{
    protected $connection = 'nasmysql';
    protected $table = 'wps';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $touches = ['project'];
  
    public function project()
    {
        return $this->belongsTo('\App\Models\Project', 'project_id', 'id');
    }
}
