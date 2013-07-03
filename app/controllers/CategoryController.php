<?php
class CategoryController extends BaseController{
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
 //新規分類項目の作成
	public function getCreate(){
		$data['category']=Item::all();
		return View::make('category/create',$data);
	}
	public function postCreate(){
		//受信データ
		$inputs=Input::only('name','description');
		//バリルール
		$rules=array(
			'name'=>'required|alpha',
			'description'=>'required',
			);
		//バリチェック
		$val=Validator::make($inputs,$rules);
		if($val->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($val);
		}
		//分類項目の登録
		Category::create($inputs);
		return Redirect::intended('admin');
	}
}