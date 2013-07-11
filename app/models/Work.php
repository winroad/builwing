<?php
class Work extends Eloquent{
 protected $softDelete=true;
 //protected $id='user_id';
 protected $guarded=array('deleted_at');
 protected $table='works';
 
	public function user(){
	return $this->hasOne('User','id');
	}
	
	public function scopeOwn($query){
		$query->find(Auth::user()->id);
		return $query;
	}
}
