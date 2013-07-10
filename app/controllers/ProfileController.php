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
| 新規入力ページ
|----------------------------------------
| 新規フィールドの作成ではなくて、
| カテゴリ内の未入力項目データ入力
*/
	public function getCreate($column=null){
		//itemsテーブルの未入力データを取得
		$data['items']=Profile::item($column,true);
		//配列数が0なら
		if(count($data['items']) == 0){
			$message='未入力データはありません';
		}else{
			$message=null;
		}
		//カテゴリデータを取得
		$category=Category::where('name','=',$column)->first();
		//項目名データを取得
		$data['description']=$category->description;
		$data['column']=$category->name;
		//新規作成ページの表示
		return View::make('profile/create',$data)
				->with('message',$message);
	}
	
	public function postCreate(){
		//POSTデータの取得
		$inputs=Input::except('id','column','_token');
		//バリデーションルールの作成
		foreach($inputs as $key=>$value):
			$rules[$key]='required';
		endforeach;
		//バリデーション処理
		$val=Validator::make($inputs,$rules);
		//バリデーションNGなら
		if($val->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($val);
		}
		$column=Input::get('column');
		//データの新規作成
		$profile=Profile::find(Auth::user()->id);
		//カラム内がNULLなら
		if($profile->$column == null){
			//入力値の配列を保存
			$profile->$column=serialize($inputs);
			$profile->save();
		}else{
		//カラム内がNULLでなければ
		$a=unserialize($profile->$column);	//元データ
		$b=$inputs;													//受信データ
		//2つの配列を併合して一つの配列へ
		$merge=array_merge($a,$b);
		//Proileを取得
		$profile=Profile::find(Auth::user()->id);
		//シリアライズ処理した配列を入力
		$profile->$column=serialize($merge);
		//データ保存
		$profile->save();
		}
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
		$data['work']=Profile::item('work');
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
| データ更新ページ
|----------------------------------------
*/
	public function getUpdateList(){
		$data['profile']=Profile::owner()->first();
		$data['address']=Profile::item('address');
		$data['body']=Profile::item('body');
		$data['license']=Profile::item('license');
		$data['work']=Profile::item('work');
		$data['family']=Profile::item('family');
		$data['note']=Profile::item('note');
		return View::make('profile/update-list',$data);
	}
	
	public function getUpdate($cat,$itm){
		//データの取得
		$data['cat']=$cat;
		$data['itm']=array_only(Profile::item($cat),array('name',$itm));
		//データ更新ページの表示
		return View::make('profile/update',$data);
	}
	
	public function postUpdate(){
		$cat=Input::get('cat');
		$itm=Input::get('itm');
		//データ受信
		$inputs=Input::except('_token','cat','itm','reason','old_itm');
		//バリルール
		foreach($inputs as $key=>$value){
			$rules=array($key=>'required');
		}
		//バリ処理
		$val=Validator::make($inputs,$rules);
		//バリNGなら
		if($val->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($val);
		}
		 
	//旧データと新データが同じで無ければ
	if(Input::get('old_itm') != Input::get($key)){
		
		/*******************
		* データ更新処理
		********************/
			 
		//受け取ったカテゴリの配列を取得
		$old_pro=Profile::item($cat);
		//受け取ったデータで旧データに修正
		$new_pro=array_merge($old_pro,$inputs);
		//受け取ったデータをシリアライズ
		$new_pro=serialize($new_pro);
		//受け取ったデータを保存
		$pro=Profile::owner()->first();
		$pro->$cat=$new_pro;
		$pro->save();
		
		/***********************
		 * 更新履歴処理
		 ***********************/
		 
		//更新履歴の必要項目取得
		$user_id=Auth::user()->id;
		$profile_id=Profile::owner()->pluck('id');
		$item_id=Item::where('name','=',$itm)->pluck('id');
		//古い項目データの取得
		$old_itm=Input::get('old_itm');
		//新しい項目データの取得
		$new_itm=Input::get($key);
		$reason=Input::get('reason');
		
		$profile=Profile::find($profile_id);
		//更新履歴
		$history=new History();
		$history->user_id=$user_id;
		$history->profile_id=$profile_id;
		$history->item_id=$item_id;
		$history->old=$old_itm;
		$history->new=$new_itm;
		if(isset($reason)){
			$history->reason=$reason;
			}
		//修正プロフィールを取得
		$profile=Profile::find($profile_id);
		//更新履歴を保存
		$profile->history()->save($history);
			
	}
		//トップページへ戻る
		return Redirect::to('profile/view/'.Auth::user()->id);
	}
}