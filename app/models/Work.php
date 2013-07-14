<?php
class Work extends Eloquent{
 protected $softDelete=true;
 protected $guraded = array('created_at', 'updated_at'); 
 
	public function user(){
	return $this->hasOne('User','id');
	}
	
	public function scopeOwn($query){
		$query->find(Auth::user()->id);
		return $query;
	}
	
	static public function order($column=null){
	 $work=Work::find(Auth::user()->id);
	 $order=isset($work->$column) ? unserialize($work->$column) : null;
		 return $order;
	}
}
