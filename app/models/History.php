<?php
class History extends Eloquent{
	
 protected $softDelete=true;
 protected $guarded=array('id');
  
/*
|------------------------------------
|　多対多関係のリレーション
|------------------------------------
*/
	public function profile(){
		return $this->belongsToMany('Profile','history_profile');
	}
/*
|------------------------------------
|　1対多関係のリレーション
|------------------------------------
*/
	public function item(){
		return $this->belongsTo('Item');
	}
	public function user(){
		return $this->belongsTo('User');
	}
/*
|---------------------------------------------
| クエリースコープ
|---------------------------------------------
*/
	//ログイン中のユーザーの更新履歴を取得
	public function scopeOwner($query){
		$query->where('user_id','=',Auth::user())
				->orderBy('created_at','desc')
				->get();
	}
}