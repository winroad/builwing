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
	
/*
|--------------------------------------------
| 各項目内の配列を取得する
|--------------------------------------------
*/
	static public function item($item){
		//ログイン中のユーザーの最新情報を取得
		$query=Profile::where('user_id','=',Auth::user()->id)
										->orderBy('created_at','desc')
										->first();
		//引数に指定した項目がNULLでなければ
		if($query->$item != null){
			//アンシリアライズして、配列データを返します。
			$data=unserialize($query->$item);
			return $data;
		//項目がNULLなら
		}else{
			return null;
		}
	}
}