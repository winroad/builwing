<?php
use Toddish\Verify\Models\User as VerifyUser;
//use Illuminate\Auth\UserInterface;
//use Illuminate\Auth\Reminders\RemindableInterface;

//class User extends Eloquent implements UserInterface, RemindableInterface {
class User extends VerifyUser{
    protected $fillable = array('name', 'password', 'salt', 'email', 'verified', 'deleted_at', 'disabled');
 
/********************************************
 * リレーションの指定
 ********************************************/
 
	public function group(){
		return $this->belongsTo('Group');
	}
	public function profile(){
		return $this->hasOne('Profile','id');
	}
	public function work(){
		return $this->hasOne('Work','id');
	}
	public function messages(){
		return $this->hasMany('Message');
	}
}