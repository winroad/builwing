<?php
class PermissionController extends BaseController{
	
/*
|----------------------------------------
| コンストラクター
|----------------------------------------
*/
 public function __construct(){
 //authフィルター
 $this->beforeFilter('auth');
 //全POSTにcsrfフィルターの適用
 $this->beforeFilter('csrf',array('on'=>'post'));
 }
 //Permission一覧
 public function getIndex(){
	 $data['permissions']=Permission::paginate();
	 return View::make('permission/index',$data);
 }
 //Permission作成View
 public function getView($id){
 }
 //Permission作成view
 public function getCreate(){
	 return View::make('permission/create');
 }
 //Permission作成post
 public function postCreate(){
	 $inputs=Input::only('name');
	 $rules=array('name'=>'required');
	 $val=Validator::make($inputs,$rules);
	 if($val->fails()){
		 return Redirect::back()
		 		->withErrors($val);
		}
				
		//permissisonの登録
		Permission::create($inputs);
		//Permissionの一覧ページへ
		return Redirect::to('permission/index');
 }

}