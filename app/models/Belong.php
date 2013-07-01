<?php
class Belong extends Eloquent{
 	protected $softDelete=true;
 	protected $guarded=array('id');
/*
|--------------------------------------------
| リレーションの指定
|--------------------------------------------
*/
	public function group(){
	return $this->belongsTo('Group');
}
}