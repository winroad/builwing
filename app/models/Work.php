<?php
class Work extends Eloquent{
 protected $softDelete=true;
 protected $guarded=array('id');
 protected $table='works';
 
	public function user(){
	return $this->hasOne('User');
	} 
}