<?php
class RoleController extends BaseController{
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
 
 public function getIndex($action=null){
	 if($action == null or $action == 'role'){
	 $data['roles']=Role::all();
	 return View::make('role/index',$data);
	 }elseif($action == 'permission'){
		 	$data['permissions']=Permission::all();
	 		return View::make('role/permission/index');
	}
 }
 public function getCreate($action=null,$id=null){
	 if($action == null or $action == 'role'){
	 $roles=Role::all();
	 //return dd($roles);
	 //$data['permissions']=DB::table('permissions')->lists('name','id');
	 //return dd($data['roles']);
	 		return View::make('role/create');
	 /*}elseif($action == 'permission'){
		 $permissions=Permission::all();
		 $data['permissions']=DB::table('permissions')
		 			->lists('name','id');
		 return View::make('role/permission/create',$data);*/
		}
 }
 public function postCreate(){
	 $inputs=Input::only('name','level');
	 //return dd($inputs);
	 $rules=array(
	 			'name'=>'required|unique:roles',
	 			'level'=>'required|integer|max:10',				
				);
	 $val=Validator::make($inputs,$rules);
	 	if($val->fails()){
		 return Redirect::back()
		 		->withInput()
				->withErrors($val);
		}
	$group=Role::create($inputs);
	
	return Redirect::to('role/index');
	
	}
	 
}

