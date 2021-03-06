<?php
class AdminController extends BaseController{
/*
|----------------------------------------
| コンストラクター
|----------------------------------------
*/
 public function __construct(){
 //adminフィルター
 //$this->beforeFilter('admin');
 $this->beforeFilter('auth');
 //全POSTにcsrfフィルターの適用
 $this->beforeFilter('csrf',array('on'=>'post'));
 }
 
	private function column($id){
		$pro=Profile::find($id);
		if(isset($pro)){
			//指定ユーザー情報を取得
			$pro=Profile::find($id)->tel;
			$data['tel']=isset($pro) ? $pro : null;
			$pro=Profile::find($id)->address;
			$data['address']=isset($pro) ? unserialize($pro) : null;
			$pro=Profile::find($id)->body;
			$data['body']=isset($pro) ? unserialize($pro) : null;
			$pro=Profile::find($id)->license;
			$data['license']=isset($pro) ? unserialize($pro) : null;
			$pro=Profile::find($id)->work;
			$data['work']=isset($pro) ? unserialize($pro) : null;
			$pro=Profile::find($id)->family;
			$data['family']=isset($pro) ? unserialize($pro) : null;
			$pro=Profile::find($id)->note;
			$data['note']=isset($pro) ? unserialize($pro) : null;
			$pro=Profile::find($id)->message;
			$data['message']=isset($pro) ? unserialize($pro) : null;
			$pro=Profile::find($id)->todo;
			$data['todo']=isset($pro) ? unserialize($pro) : null;
		
			return $data;
		}
		return null;
	}
/*
|------------------------------------
| TOPページ
|------------------------------------
*/
 public function getIndex($action=null,$id=null){
	 return View::make('admin/index');
 }
/*
|------------------------------------
| ユーザー操作
|------------------------------------
*/
	//ユーザー表示
	public function getUser($action=null,$id=null){
		//viewの表示
		if($action == 'view' and $id != null){
			//オブジェクトをセット
			$data['user']=User::find($id);
			//配列をセット
			$data['profile']=$this->column($id);
			//return var_dump($data['profile']);
			return View::make('admin/user/view',$data);
		}elseif($id != null){
			//$idがNULLなら全ユーザー表示
			$data['user']=User::find($id);
			return View::make('admin/user/index',$data);
		}
		//indexビューの表示
			$data['users']=User::paginate(20);
			return View::make('admin/user/index',$data);
	}
	//ユーザーのデータ処理
	public function postUser($action=null,$id=null){
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
	 $data['roles']=Role::orderBy('level')->lists('name','id');
 			return View::make('admin/user/create',$data);
 }
 //POSTの処理
 public function postCreate(){
 //受信データの整理
 $inputs=Input::only('name','email','password','verified');
 //return dd($inputs);
 //バリデーションの指定
 $rules=array(
 'name'=>'required',
 'email'=>'required|email|unique:users',
 'password'=>'required|between:8,16',
 );
 //バリデーションチェック
 $val=Validator::make($inputs,$rules);
 //バリデーションNGなら
 if($val->fails()){
 return Redirect::back()
 ->withErrors($val)
 ->withInput();
 }
 //return var_dump($inputs);
 
 /*******************************
  *  新規作成
	*******************************/
	//即時認証
	if(Input::get('verified') == 1){
	$role_id=Input::get('role_id');
	//return dd($role_id);
	$user=User::create($inputs);
	$profile['id']=$user->id;
	//profileの作成
	$pro=Profile::create($profile);
	$work['id']=$user->id;
	//workの作成
	Work::create($work);
	//ユーザーの作成
	$user->save();
	//ロールの作成
	$user->roles()->sync(array($role_id));
	
	return View::make('admin/index')
				->with('warning','ユーザーの即時登録が完了しました');
	//メール認証手続き
	}else{
		//メール送信データの整理
		$data['name']=Input::get('name');
		$data['password']=mt_rand(0,99999999);
		$data['onepass']=md5(time());
		$data['limit']=date('Y/m/d H:i:s',time()+172800);
		//メール送信
		Mail::send('emails.auth.activate',$data,
			function($m){
				$email=Input::get('email');
				$name=Input::get('name');
				$m->to($email,$name)
				->subject('アクティベーション');
			});
			
		//仮登録手続き
		$activate=new Activate();
		$activate->name=Input::get('name');
		$activate->password=$data['password'];
		$activate->email=Input::get('email');
		$activate->role_id=Input::get('role_id');
		$activate->onepass=$data['onepass'];
		$activate->limit=$data['limit'];
		$activate->save();
		
		return View::make('admin/index')
				->with('warning','ユーザー仮登録が完了しました');
		}
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
		return Redirect::to('admin/user')
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
/*
|------------------------------------
| Userのプロフィール操作
|------------------------------------
*/
	private function col($col='null',$id){
		//指定ユーザー情報を取得
		$pro=Profile::find($id);
		if($pro->$col != null){
			//アンシリアライズして、配列データを返します。
			$data=unserialize($pro->$col);
			return $data;
		}else{
			return null;
		}
	}

	public function getProfile($action=null,$id=null){
		//viewページへ
		if($action == 'view' and $id != null){
			$data['name']=Profile::find($id)->user->name;
			$data['tel']=Profile::find($id)->tel;
			$data['address']=$this->col('address',$id);
			$data['body']=$this->col('body',$id);
			$data['license']=$this->col('license',$id);
			$data['work']=$this->col('work',$id);
			$data['family']=$this->col('family',$id);
			$data['note']=$this->col('note',$id);
			$data['message']=$this->col('message',$id);
			$data['todo']=$this->col('todo',$id);
			$data['created_at']=Profile::find($id)->created_at;
			$data['updated_at']=Profile::find($id)->updated_at;
			//return var_dump($data['address']);
			//viewページへ
			return View::make('admin/profile/view',$data);
		}elseif($action == 'update' and $id != null){
			return 'update page!!';
		}
		//上記以外は全てindexページへ	
		$data['profiles']=Profile::all($id);
		return View::make('admin/profile/index',$data);
	}
}