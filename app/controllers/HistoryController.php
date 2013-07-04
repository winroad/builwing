<?php

class HistoryController extends BaseController {
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
	 //$data['hist']=History::first()->id;
	 //return var_dump($data);
	 $data['profiles']=Profile::get();
	 return View::make('history/index',$data);
 }
 
 
 public function getView($id){
	 $data['histories']=History::where('profile_id','=',$id)
	 			->orderBy('created_at','desc')
				->get();
	 return View::make('history/view',$data);
 }
}