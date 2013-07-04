<?php
class Category extends Eloquent{
 protected $softDelete=true;
 protected $guarded=array('id');
 
/*
|------------------------------------
| 1対多関係のリレーション
|------------------------------------
| CategoryはたくさんのItemを持つ
| Category::find(1)->item;
| でCategoryのItemへアクセスできます。
|
*/
 //1対多関係のリレーション
	public function item(){
		return $this->hasMany('Item');
	}
}