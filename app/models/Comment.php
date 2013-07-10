<?php
class Comment extends Eloquent{
 protected $softDelete=true;
 protected $guarded=array('id');
 
	//コメントはメッセージに属しています。
	public function message(){
	return $this->belongsTo('Message');
	}
 
	//コメントは多くのユーザーに属しています。
	public function user(){
	return $this->belongsToMany('User');
	}
 
}