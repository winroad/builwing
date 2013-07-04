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
	public function scopeOwner($query){
		//ユーザーの更新履歴取得
		$query->where('user_id','=',Auth::user())
				->orderBy('created_at','desc')
				->get();
	}
	public function scopeTb($query){
		//全ての更新データ取得
			return $query->orderBy('created_at','desc');
	}
}