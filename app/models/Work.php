<?php

class Work extends Eloquent{
 protected $softDelete=true;
 //protected $id='user_id';
 protected $guarded=array('user_id');
 
	public function user(){
	return $this->hasOne('User','id');
	}
	
	public function scopeOwn($query){
		$query->find(Auth::user()->id);
		return $query;
	}
	
	public static function order($column){
	 $work=Work::find(Auth::user()->id);
	 $order=isset($work->$column) ? unserialize($work->$column) : null;
		 return $order;
	}
}
