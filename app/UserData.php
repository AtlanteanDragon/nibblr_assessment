<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
	protected $primaryKey = "id"
    protected $fillable = [
    	 'street', 'number', 'city'
    ];
    public User(){
    	return $this->hasOne('App\User');
    }
    public dinner(){
    	return $this->hasMany('App\Dinner')
    }
    public UserDinner(){
    	return $this->belongsTo('App\UserDinner');
    }
}
