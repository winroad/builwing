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
	 * worksテーブルのcomment項目に配列保存
	 *****************************************
		
		//個人宛メッセージのコメントなら
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
		//Role宛てメッセージなら
		}else{
			//新コメント
			$new=array($comment->id);
			//return dd(Input::all());
			//指定Roleのユーザーを取得
			$role=Role::find($message->role_id);
			$users=User::find($role);
			//return dd($users);
			//ユーザーの数だけ繰り返し
			foreach($users as $user):
				//旧メッセージの取得
				$work=Work::find($user->id);
				//return dd($user->id);
				$old=isset($work->comment) ? unserialize($work->comment) : array();
				//配列の併合
				$merge=isset($old) ? array_merge($old,$new) : $new;
				//return var_dump($merge);
				//登録データの保存
				$work->comment=serialize($merge);
				$work->save();
			endforeach;
		}
	//トップページへ移動
	return Redirect::to('comment/index');*/
	}
/*
|------------------------------------
| 未読コメント
|------------------------------------
*/
	public function getUnread($id=null,$key=null){
		//ログインユーザーのWorkオブジェクトを取得
		$work=Work::find(Auth::user()->id);
		//return dd($work->comment);
		//未読コメントがなければ
		if($work->comment == null or unserialize($work->comment) == null){
			return View::make('comment/unread')
				->with('warning','未読コメントはありません');
		}
		//指定IDが未読メッセージの中にあれば
		if(isset($id) and in_array($id,unserialize($work->comment))){
				//未読コメントIDの配列を取得
				$unread=unserialize($work->comment);
					//未読メッセージを削除
					array_pull($unread,$key);
					//配列のキーを前に詰める
					$unread=array_values($unread);
					//return dd($unread);
				$comment=serialize($unread);
				$work->comment=$comment;
				$work->save();
				$id=Comment::find($id)->message_id;
				//return dd($id);
				//削除後に明細ページへ移動
				return Redirect::to('message/view/'.$id);
		}
		//未読コメントの配列取得
		$unread=isset($work) ? unserialize($work->comment) : null;
		//return dd($unread);
		//配列の数だけオブジェクトを取得
		foreach($unread as $key=>$value):
			$data['comments'][]=Comment::find($value);
			//return dd(Comment::find($value));
		endforeach;
		return View::make('comment/unread',$data);
	}
}