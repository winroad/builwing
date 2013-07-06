<?php
class Message extends Eloquent{
 protected $softDelete=true;
 protected $guarded=array('id');
 
	//リレーション
	public function role(){
	return $this->belongsToMany('Role');
	}
 
}