<?php
class Item extends Eloquent{
	
 protected $softDelete=true;
 protected $guarded=array('id');
  
/*
|------------------------------------
| 1対多関係のリレーション
|------------------------------------
| ItemはCategoryに属している
| Item::find(1)->category;
| でItemのcategoryへアクセスできます。
|
*/
	public function category(){
		return $this->belongsTo('Category');
	}
	
	public function history(){
		return $this->hasMany('History');
	}
}