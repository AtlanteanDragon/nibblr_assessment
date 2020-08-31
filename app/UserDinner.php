<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDinner extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $fillable = [
    	'user_data_id',
    	'dinner_id'
    ];
    public dinner(){
        return $this->hasMany('App\Dinner', 'dinner_id');
    }
    public UserData(){
        return $this->hasMany('App\UserData', 'user_data_id');
    }

}
