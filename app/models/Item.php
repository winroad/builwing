<?php
class Item extends Eloquent{
	
 protected $softDelete=true;
 protected $guarded=array('id');
  
/*
|------------------------------------
| 1対多関係のリレーション
|------------------------------------
| ItemはCategoryに属している
| Item::find(1)->categories;
| でItemのcategoryへアクセスできます。
|
*/
	public function categories(){
		return $this->belongsTo('Category');
	}
}