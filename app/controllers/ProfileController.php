<?php
class ProfileController extends BaseController{
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
 
/*
|----------------------------------------
| Topページ
|----------------------------------------
*/
	public function getIndex(){
		//データの取得
		$data['profiles']=Profile::all();
		return View::make('profile/index',$data);
	}
/*
|----------------------------------------
| 新規作成ページ
|----------------------------------------
*/
	public function getCreate(){
		//新規作成ページの表示
		return View::make('profile/create');
	}
	public function postCreate(){
		//POSTデータの取得
		$inputs=Input::except('id');
		//バリデーションルールの作成
		$rules=array(
			'tel'=>'required',
			);
		//バリデーション処理
		$val=Validator::make($inputs,$rules);
		//バリデーションNGなら
		if($val->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($val);
		}
		//データの新規作成
		Profile::create($inputs);
		//一覧ページへ移動
		return Redirect::to('profile/index')
			->with('message','データを作成しました');
	}
/*
|----------------------------------------
| 詳細ページ
|----------------------------------------
*/
	public function getView($id){
	//データの取得
	$data['profile']=Profile::find($id);
	$data['address']=Profile::item('address');
	$data['body']=Profile::item('body');
	$data['license']=Profile::item('license');
	$data['labor']=Profile::item('labor');
	$data['family']=Profile::item('family');
	//プロフィール数が0で無ければ
	if(isset($data['profile'])){
		return View::make('profile/view',$data);
		}
		return Redirect::action('ProfileController@getCreate')
			->with('message','プロフィールを作成してください');
	}
/*
|----------------------------------------
| 項目作成
|----------------------------------------
*/
	public function getItem($item){
		$data['item']=$item;
		$profiles=Profile::orderBy('created_at','desc')->first();
		return View::make('profile/item',$data);
	}
	public function postItem(){
		//受信データ
		$inputs=Input::only('name','detail');
		//バリデーションルール作成
		$rules=array(
			'name'=>'required',
			'detail'=>'required',
			);
		//バリデーション処理
		$val=Validator::make($inputs,$rules);
		//バリデーションNGなら
		if($val->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($val);
		}
		//データの整理
		$item=Input::get('item');
		$name=Input::get('name');
		$detail=Input::get('detail');
		$profile=Profile::where('user_id','=',Auth::user()->id)
			->orderBy('created_at','desc')
			->first();
		//項目内が空でなければ
		if($profile->$item != null){
		$data=unserialize($profile->$item);
		$data+=array($name=>$detail);
		$profile->$item=serialize($data);
		//項目内が空なら
		}else{
		$profile->$item=serialize(array($name=>$detail));
		}
		//データの登録
		$profile->save();
		//Profile/viewへ移動
		return Redirect::to('profile/view/'.Auth::user()->id)
			->with('message','データを作成しました');
	}
}