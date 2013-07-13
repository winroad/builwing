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
	return $this->belongsTo('User');
	}
	
/*
|--------------------------------------------
| スコープ
|--------------------------------------------
*/
	//ユーザー所有のメッセージ
	public function scopeOwn($query){
		$user=Auth::user();
		$role=$user->roles->first();
		$query=Message::where('recipient_id','=',$user->id)
			->orWhere('role_id','<=',$role->id)
	 		->orderBy('created_at','desc')
			->get();
		return $query;
	}
}