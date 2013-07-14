<?php
class Comment extends Eloquent{
 protected $softDelete=true;
 protected $guarded=array('id');
 
	//コメントはメッセージに属しています。
	public function message(){
	return $this->belongsTo('Message');
	}
 
	//コメントはユーザー（送信者）に属しています。
	public function user(){
	return $this->belongsTo('User');
	} 
}