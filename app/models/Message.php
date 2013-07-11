<?php
class Message extends Eloquent{
	
 protected $softDelete=true;
 protected $guarded=array('id');
 
	//MessageはたくさんのCommentを持つ
	public function comments(){
	return $this->hasMany('Comment');
	}
	//MessageはたくさんのUserに属しています。
	public function user(){
	return $this->belongsToMany('User');
	}
	
/*
|--------------------------------------------
| スコープ
|--------------------------------------------
*/
	//ユーザー所有のメッセージ
	public function scopeOwn($query){
		$query=Message::where('recipient_id','=',Auth::user()->id)
			//->orWhere('role_id','>=',Auth::user()->group_id)
	 		->orderBy('created_at','desc');
		return $query;
	}
}