<?php
class GroupController extends BaseController{
/*
|----------------------------------------
| コンストラクター
|----------------------------------------
*/
 public function __construct(){
 //adminフィルター
 $this->beforeFilter('auth');
 //全POSTにcsrfフィルターの適用
 $this->beforeFilter('csrf',array('on'=>'post'));
 }
 
 public function getIndex(){
	 $data['groups']=Group::get();
	 return View::make('group/index',$data);
 }
 public function getCreate(){
	 return View::make('group/create');
 }
 public function postCreate(){
	 $inputs=Input::except('_token','name');
	 $name=Input::only('name');
	 $rules=array('name'=>'required|unique:groups');
	 $val=Validator::make($name,$rules);
	 	if($val->fails()){
		 return Redirect::back()
		 		->withInput()
				->withErrors($val);
		}
		$data['name']=Input::get('name');
		foreach($inputs as $input){
			$data['permissions'][$input]=array_add(array($input),$input,1);
			
		}
			$group=Sentry::getGroupProvider()->create($data);
	return Redirect::to('group/index');
	}
	 
}

