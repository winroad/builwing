<?php
class Category extends Eloquent{
 protected $softDelete=true;
 protected $guarded=array('id');
 
/*
|------------------------------------
| 1対多関係のリレーション
|------------------------------------
| CategoryはたくさんのItemを持つ
| Category::find(1)->items;
| でCategoryのItemへアクセスできます。
|
*/
 //1対多関係のリレーション
	public function items(){
		return $this->hasMany('Item');
	}
}