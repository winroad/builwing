<?php
class Labor extends Eloquent{
 protected $softDelete=true;
 protected $guarded=array('id');
 
	public function user(){
	return $this->hasOne('User');
	} 
}