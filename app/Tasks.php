<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    //protected $dates = ['deleted_at'];
    public function tasks(){
  		return $this->belongsTo('App\User');
  	}
    protected $fillable = [
        'title',
        'user_id',
        'details',
        'completed',
    ];
}
