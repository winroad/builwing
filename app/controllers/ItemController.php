<?php
class ItemController extends BaseController{
/*
|----------------------------------------
| コンストラクター
|----------------------------------------
*/
 public function __construct(){
 //adminフィルター
 $this->beforeFilter('admin');
 //全POSTにcsrfフィルターの適用
 $this->beforeFilter('csrf',array('on'=>'post'));
 }
 
 public function getIndex(){
	 echo 'getIndexです。';
 }
 //新規項目の作成
	public function getCreate(){
		$data['categories']=Category::all()->lists('name','id');
		return View::make('item/create',$data);
	}
	public function postCreate(){
		//受信データ
		$inputs=Input::only('name','category_id');
		//バリルール
		$rules=array(
			'name'=>'required',
			);
		//バリチェック
		$val=Validator::make($inputs,$rules);
		if($val->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($val);
		}
		//Itemの新規作成
		Item::create($inputs);
		return Redirect::intended('admin');
	}
}