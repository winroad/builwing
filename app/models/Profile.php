<?php
class Profile extends Eloquent{
 	protected $softDelete=true;
 	protected $guarded=array('id');
/*
|--------------------------------------------
| リレーションの指定
|--------------------------------------------
*/
	public function user(){
	return $this->belongsTo('User');
}
}