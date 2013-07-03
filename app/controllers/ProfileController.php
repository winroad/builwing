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
	public function getCreate($column){
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
		$profile=Profile::where('user_id','=',Auth::user()->id)->first();
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
		$profile=Profile::where('user_id','=',Auth::user()->id)->first();
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
		$data['labor']=Profile::item('labor');
		$data['family']=Profile::item('family');
		//プロフィール数が0で無ければ
		if(isset($data['profile'])){
			return View::make('profile/view',$data);
		}
			return Redirect::action('ProfileController@getCreate')
					->with('message','プロフィールを作成してください');
	}
}