<?php
class AdminController extends BaseController{
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
/*
|------------------------------------
| TOPページ
|------------------------------------
*/
 public function getIndex(){
	 return View::make('admin/index');
 }
/*
|------------------------------------
| ユーザー一覧ページ
|------------------------------------
| 1. getで全ユーザー表示
| 2. postでユーザー検索
*/
//全ユーザー表示
 public function getUser(){
	 $data['users']=User::paginate(10);
	 return View::make('admin/user/index',$data);
 }
 //検索ユーザー表示
 public function postUser(){
	 $inputs=Input::get('search');
	 $data['users']=User::where('name','LIKE','%'.$inputs.'%')->paginate(10);
	 return View::make('admin/user/index',$data);
 }
/*
|-----------------------------------
| ユーザー新規作成
|-----------------------------------
| 1.GETでビューの表示
| 2.POSTでユーザー登録
*/
 //GETの処理
 public function getCreate(){
	 //ロール名リスト作成
	 $data['roles']=Role::orderBy('id','desc')->lists('name','id');
	 //グループ名リスト作成
	 $data['groups']=Group::lists('name','id');
 			return View::make('admin/user/create',$data);
 }
 //POSTの処理
 public function postCreate(){
 //受信データの整理
 $inputs=Input::all();
 //バリデーションの指定
 $rules=array(
 'name'=>'required',
 'email'=>'required|email|unique:users',
 'password'=>'required|min:4',
 );
 //バリデーションチェック
 $val=Validator::make($inputs,$rules);
 //バリデーションNGなら
 if($val->fails()){
 return Redirect::back()
 ->withErrors($val)
 ->withInput();
 }
 //ユーザーの新規作成
 $inputs['onepass']=md5(Input::get('name').time());
 //新規作成
 $user=User::create($inputs);
	//コントローラアクションへパラメーターを渡し、リダレクト
	return Redirect::action('AdminController@getView',array('id'=>$user->id));
 }
/*
|------------------------------------
| ユーザー詳細ページ
|------------------------------------
*/
 public function getView(){
	 $id=Input::get('id');
	 $data['user']=User::find($id);
	 return View::make('admin/user/view',$data);
 }
/*
|------------------------------------
| ユーザー更新ページ
|------------------------------------
*/
	public function getUpdate(){
		$id=Input::get('id');
		//更新ユーザーデータの取得
		$data['user']=User::find($id);
		//ロールリストの作成
	  $data['roles']=Role::orderBy('id','desc')->lists('name','id');
		//グループリストの作成
	  $data['groups']=Group::lists('name','id');
		return View::make('admin/user/update',$data);
	}
	public function postUpdate(){
		//受信データの整理
		$inputs=Input::all();
 		//バリデーションの指定
		 $rules=array(
 			'name'=>'required',
 			'email'=>'required|email',
 		);
 		//バリデーションチェック
		 $val=Validator::make($inputs,$rules);
 		//バリデーションNGなら
 		if($val->fails()){
			 return Redirect::back()
 				->withErrors($val)
 				->withInput();
 		}
		//ユーザー情報の更新
		$id=Input::get('id');
		$user=User::find($id);
		$user->name=Input::get('name');
		$user->email=Input::get('email');
		$user->activate=Input::get('activate');
		$user->role_id=Input::get('role_id');
		$user->group_id=Input::get('group_id');
		$user->save();
		$data['users']=$user;
		//コントローラアクションへ名前付きパラメーターを渡し、リダレクト
		//return Redirect::action('AdminController@getUpdate',array('id'=>$id))
		return Redirect::back()
		->with('warning','データを更新しました');
	}
/*
|------------------------------------
| ユーザー削除ページ
|------------------------------------
*/
	public function getDelete(){
		$id=Input::get('id');
		$data['user']=User::find($id);
		return View::make('admin/user/delete',$data);		
	}
	public function postDelete(){
		$id=Input::get('id');
		User::destroy($id);
		return Redirect::to('admin/user/index');		
	}
/*
|------------------------------------
| 削除ユーザー一覧
|------------------------------------
*/
	public function getDeleted(){
		$data['users']=User::onlyTrashed()->paginate(10);
		return View::make('admin/user/index',$data)
			->with('warning','削除ユーザー一覧');
	}
	public function postDeleted(){
	 $inputs=Input::get('search');
	 $data['users']=User::onlyTrashed()
	 		->where('name','LIKE','%'.$inputs.'%')
			->paginate(10);
	 return View::make('admin/user/index',$data)
			->with('warning','削除ユーザー一覧');
	}
/*
|------------------------------------
| 削除ユーザーの復活
|------------------------------------
*/
	public function getRestore(){
		$id=Input::get('id');
		$user=User::onlyTrashed()->where('id',$id)->restore();
		return Redirect::back()
			->with('waning','ユーザーを復活させました');
	}
/*
|------------------------------------
| グループの表示
|------------------------------------
*/
	public function getGroup(){
		$data['groups']=Group::all();
		return View::make('admin/group/index',$data);
	}
	public function getGroupView($id){
		$data['group']=Group::find($id);
		$data['belongs']=Belong::where('group_id','=',$id)
			->orderBy('id','desc')
			->first();
		return View::make('admin/group/view',$data);
	}
/*
|------------------------------------
| グループの新規作成
|------------------------------------
*/
	public function getGroupCreate(){
	 //所属名リスト作成
	 $data['groups']=Group::orderBy('id','desc')->lists('name','id');
	 $data['belongs']=Belong::orderBy('id','desc')->lists('name','id');
		return View::make('admin/group/create',$data);
	}
	public function postGroupCreate(){
		$inputs=Input::all();
 		//バリデーションの指定
		 $rules=array(
 			'name'=>'required',
 			'abbreviation'=>'required',
 		);
 		//バリデーションチェック
		 $val=Validator::make($inputs,$rules);
 		//バリデーションNGなら
 		if($val->fails()){
			 return Redirect::back()
 				->withErrors($val)
 				->withInput();
 		}
 	$group=Group::create($inputs);
	//グループ一覧へリダイレクト
	return Redirect::to('admin/group')
		->with('warning','グループを作成しました');
	}
/*
|------------------------------------
| グループの更新
|------------------------------------
*/
	public function getGroupUpdate(){
		return View::make('admin/group/update');
	}
}