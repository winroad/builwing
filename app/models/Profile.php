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
	return $this->hasOne('User');
	}
	
	public function history(){
	return $this->belongsToMany('History');
	}
	
/*
|--------------------------------------------
| 各項目内の配列を取得する
|--------------------------------------------
| 第2引数がtrueなら、未入力配列をリターンする
*/
	static public function item($item,$empty=false){
		//ログイン中のユーザーの最新情報を取得
		$query=Profile::where('user_id','=',Auth::user()->id)
										->orderBy('created_at','desc')
										->first();
		//第2引数がfalseなら項目内の配列をリターン
		if($query->$item != null and $empty==false){
			//アンシリアライズして、配列データを返します。
			$data=unserialize($query->$item);
			return $data;
		//第2引数がtrueなら項目内の未入力配列をリターン
		}elseif($query->$item != null and $empty == true){
			//カテゴリIDの取得
			$cat=Category::where('name',$item)->first();
			//登録アイテムを取得
			$regist_item=Item::where('category_id',$cat->id)->lists('id','name');
			//登録済みアイテムを取得
			$my_item=unserialize($query->$item);
			//登録アイテムから登録済みアイテムを取り除く
			foreach($my_item as $key=>$value):
				if(array_key_exists($key,$my_item)){
					array_pull($regist_item,$key);
				}
				endforeach;
			return $regist_item;
		//項目内が未入力で、第2引数がtrueなら
		}elseif($query->$item == null and $empty == true){
			//カテゴリIDの取得
			$cat=DB::table('categories')->where('name','=',$item)->pluck('id');
			//登録アイテムを取得
			$regist_item=DB::table('items')->where('category_id','=',$cat)->lists('id','name');
			return $regist_item;
		}else{
			//項目がNULLなら
			return null;
		}
	}
/*
|--------------------------------------------
| スコープ
|--------------------------------------------
*/
	public function scopeOwner($query){
		 return $query->where('user_id','=',Auth::user()->id)
						->orderBy('created_at','desc');
	}
}