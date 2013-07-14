<?php
class Message extends Eloquent{
	
 protected $softDelete=true;
 protected $guarded=array('id');
	
	//MessageはたくさんのCommentを持つ
	public function comments(){
	return $this->hasMany('Comment');
	}
	//MessageはUser（作成者）に属しています。
	public function user(){
	return $this->belongsTo('User');
	}
	
}