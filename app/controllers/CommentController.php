<?php
class CommentController extends BaseController{
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
	 return View::make('message/index');
	 echo 'コメントのgetIndexです。';
 }
 //コメントの作成ビュー
 public function getCreate($id=null){
	 $data['id']=$id;
	 return View::make('comment/create',$data);
	}
	//コメント作成
 public function postCreate(){
	 $inputs=Input::all();
	 $rules=array('body'=>'required');
	 $val=Validator::make($inputs,$rules);
	 //return dd($inputs);
	 if($val->fails()){
		 return Redirect::back()
		 		->withInput()
				->withErrors($val);
		}
		$comment=Comment::create($inputs);
		$message=Message::find(Input::get('message_id'));
		//$comment=$message->comments()->save($comment);
		//$comment->save;
		//return Redirect::to('message/view/'.$message->id);
	
	/*****************************************
	 * 未読処理
	 * worksテーブルのmessage項目に配列保存
	 *****************************************/
		
		//個人宛メッセージなら
		if(isset($message->recipient_id)){
			//受信メッセージの整理
			$work=Work::find($message->recipient_id);
			//旧コメント
			$old=isset($work->comment) ? unserialize($work->comment) : array();
			//return dd($old);
			//新コメント
			$new=array($comment->id);
			//return dd($new);
			//配列の併合
			$merge=isset($old) ? array_merge($old,$new) : $new;
			//登録データの保存
			//return dd(serialize($merge));
			$work->comment=serialize($merge);
			//return dd($work->comment);
			$work->save();
		//グループ宛てメッセージなら
		}else{
			//新メッセージ
			$new=array($message->id);
			//指定グループのユーザーを取得
			$users=Sentry::getUserProvider()->findAllInGroup('Admin');
			return dd($users);
			//ユーザーの数だけ繰り返し
			foreach($users as $user):
				//旧メッセージの取得
				$work=Work::where('user_id',$user->id)->first();
				$old=isset($work->message) ? unserialize($work->message) : array();
				//配列の併合
				$merge=isset($old) ? array_merge($old,$new) : $new;
				//return var_dump($merge);
				//登録データの保存
				$work->message=serialize($merge);
				$work->save();
			endforeach;
		}
	//トップページへ移動
	return Redirect::to('comment/index');
	}
	
}