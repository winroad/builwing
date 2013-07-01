<?php
class Role extends Eloquent{
 protected $softDelete=true;
 protected $guarded=array('id');
 
	/*public function lists(){
	 $lists=Role::all()->lists('name');
			return var_dump($lists);
 }*/
}