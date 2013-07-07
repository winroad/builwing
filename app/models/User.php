<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * モデルで使用されるデータベース
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * モデルのJSON形式に含めない項目
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * ユーザーのユニークな識別子の取得.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * ユーザーのパスワードの取得
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * パスワードリマインダーを送信するメールアドレスの取得
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
/*
|---------------------------------------------
| パスワードセッター
|---------------------------------------------
*/
public function setPasswordAttribute($value){
$this->attributes['password']=Hash::make($value);
}
/*
|--------------------------------------------
| 複数代入禁止フィールドの指定
|--------------------------------------------
*/
protected $guarded=array('id');
 
/*
|--------------------------------------------
| リレーションの指定
|--------------------------------------------
*/
public function role(){
return $this->belongsTo('Role');
}
public function group(){
return $this->belongsTo('Group');
}
public function profile(){
return $this->hasOne('Profile');
}
public function work(){
return $this->hasOne('Work');
}
/*
|--------------------------------------------
| ソフトデリートの設定
|--------------------------------------------
*/
 protected $softDelete=true;
}