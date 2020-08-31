<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dinner extends Model
{
	    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $fillable = [
    	'user_data_id', 'max_guests', 'start_date', 'duration', 'title', 'description'
    ];
    protected $casts =  []
    public UserData(){
    	return $this->belongsTo('App\UserData');
    }
    public UserDinner(){
    	return $this->belongsTo('App\UserDinner');
    }
}
