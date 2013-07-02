<?php
class SetupController extends BaseController{
//セットアップビューの表示
public function getIndex(){
	return View::make('setup/index');
}
//usersテーブルの作成
public function getUsers(){
	//usersテーブルの存在確認
 	if(Schema::hasTable('users')){
		$data['warning']='usersテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//usersテーブルの作成
 	Schema::create('users',function($table){
 		$table->increments('id');
		$table->string('name',32);
 		$table->string('email',100);
 		$table->string('password',64);
 		$table->string('onepass');
 		$table->tinyinteger('activate')->default(0);
 		$table->integer('role_id')->nullable();
 		$table->integer('group_id')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//deleted_atカラムを追加
		$table->timestamp('deleted_at')->nullable();
 	});
	//初期Adminの作成
	User::create(array(
			'name'=>'Admin',
			'email'=>'admin@winroad.jp',
			'password'=>'admin',
			'onepass'=>md5('admin'.time()),
			'activate'=>1,
			'role_id'=>1,
			'group_id'=>1,
			));
		$data['warning']='usersテーブルを作成しました。';
		return View::make('setup/index',$data);
 	}
/*
|---------------------------------------------
|	profilesテーブルの作成
|---------------------------------------------
*/
public function getProfiles(){
	//usersテーブルの存在確認
 	if(Schema::hasTable('profiles')){
		$data['warning']='profilesテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//usersテーブルの作成
 	Schema::create('profiles',function($table){
 		$table->increments('id');
		//usersテーブルへのリレーション用
		$table->integer('user_id')->nullable();
		//電話番号
		$table->string('tel',20)->nullable();
		//address関連情報（シリアライズ）
		$table->text('address')->nullable();
		//身体関連情報(シリアライズ)
 		$table->text('body')->nullable();
		//資格関連情報(シリアライズ)
 		$table->text('license')->nullable();
		//労務関連情報(シリアライズ)
 		$table->text('labor')->nullable();
		//家族関連情報(シリアライズ)
 		$table->text('family')->nullable();
		//その他(シリアライズ)
 		$table->text('note')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//deleted_atカラムを追加
		$table->timestamp('deleted_at')->nullable();
 	});
		$data['warning']='profilesテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
/*
|---------------------------------------------
|	rolesテーブルの作成
|---------------------------------------------
*/
public function getRoles(){
	//rolesテーブルの存在確認
 	if(Schema::hasTable('roles')){
		$data['warning']='rolesテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//rolesテーブルの作成
 	Schema::create('roles',function($table){
 		$table->increments('id');
		$table->string('name',32);
 		$table->integer('level')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//deleted_atカラムを追加
		$table->timestamp('deleted_at')->nullable();	
 	});
	//新規Roleの作成
	Role::create(array(
			'name'=>'Admin',
			'level'=>100,
			));
	Role::create(array(
			'name'=>'Manager',
			'level'=>70,
			));
	Role::create(array(
			'name'=>'Moderator',
			'level'=>50,
			));
	Role::create(array(
			'name'=>'Staff',
			'level'=>30,
			));
	Role::create(array(
			'name'=>'User',
			'level'=>1,
			));
	Role::create(array(
			'name'=>'Banned',
			'level'=>0,
			));
		$data['warning']='rolesテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
/*
|---------------------------------------------
|	groupsテーブルの作成
|---------------------------------------------
*/
public function getGroups(){
	//groupsテーブルの存在確認
 	if(Schema::hasTable('groups')){
		$data['warning']='groupsテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//groupsテーブルの作成
 	Schema::create('groups',function($table){
 		$table->increments('id');
		//グループ略称
		$table->string('abbreviation',100);
		//グループ名(会社名・所属先)
		$table->string('name',100);
 		$table->integer('level')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//deleted_atカラムを追加
		$table->timestamp('deleted_at')->nullable();		
 	});
	//新規Groupの作成
	Group::create(array(
			'abbreviation'=>'Builwing',
			'name'=>'株式会社ビルウイング',
			'level'=>100,
			));
		$data['warning']='groupsテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
/*
|---------------------------------------------
|	belongs(部署・所属先)テーブルの作成
|---------------------------------------------
*/
public function getBelongs(){
	//belongsテーブルの存在確認
 	if(Schema::hasTable('belongs')){
		$data['warning']='belongsテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//belongsテーブルの作成
 	Schema::create('belongs',function($table){
 		$table->increments('id');
		//部署名
		$table->string('name',100)->nullable();
		$table->integer('group_id')->nullable();
		//address関連情報(シリアライズ)
 		$table->text('address')->nullable();
		//取引関連情報(シリアライズ)
 		$table->text('business')->nullable();
		//内部関連情報(シリアライズ)
 		$table->text('inside')->nullable();
		//備考情報(シリアライズ)
 		$table->text('note')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//deleted_atカラムを追加
		$table->timestamp('deleted_at')->nullable();		
 	});
		$data['warning']='belongsテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
	
/*
|---------------------------------------------
|	items(項目)テーブルの作成
|---------------------------------------------
|	1. 項目管理用のテーブル
|	2. profilesやbelongsで使用予定
*/
	public function getItems(){
	//itemsテーブルの存在確認
 	if(Schema::hasTable('items')){
		$data['warning']='itemsテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//itemsテーブルの作成
 	Schema::create('items',function($table){
 		$table->increments('id');
		//iteme名
		$table->string('name',100);
		//分類コード
		$table->integer('category_id')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//deleted_atカラムを追加
		$table->timestamp('deleted_at')->nullable();		
 	});
		$data['warning']='itemsテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
/*
|---------------------------------------------
|	category(分類)テーブルの作成
|---------------------------------------------
|	1. 分類項目管理用のテーブル
|	2. profilesやbelongsで使用予定
*/
	public function getCategories(){
	//categoriesテーブルの存在確認
 	if(Schema::hasTable('categories')){
		$data['warning']='categoriesテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//categoriesテーブルの作成
 	Schema::create('categories',function($table){
 		$table->increments('id');
		//categorye名
		$table->string('name',50);
		//categoryの説明
		$table->text('description')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//deleted_atカラムを追加
		$table->timestamp('deleted_at')->nullable();		
 	});
		$data['warning']='categoriesテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
/*
|---------------------------------------------
|	users関連テーブルの一括作成
|---------------------------------------------
|	1.usersテーブルの作成
|	2.profileテーブルの作成
|	3.rolesテーブル及び基本Roleの作成
|	4.groups(会社、所属先)テーブルの作成
|	5.belong(部署)テーブルの作成
|
*/
//usersテーブルの作成
public function getAll(){
	//usersテーブルの存在確認
 	if(Schema::hasTable('users')){
		$data['warning']='usersテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//usersテーブルの作成
 	Schema::create('users',function($table){
 		$table->increments('id');
		$table->string('name',32);
 		$table->string('email',100);
 		$table->string('password',64);
 		$table->string('onepass');
 		$table->tinyinteger('activate')->default(0);
 		$table->integer('role_id')->nullable();
 		$table->integer('group_id')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//deleted_atカラムを追加
		$table->timestamp('deleted_at')->nullable();
 	});
	//初期Adminの作成
	User::create(array(
			'name'=>'Admin',
			'email'=>'admin@winroad.jp',
			'password'=>'admin',
			'onepass'=>md5('admin'.time()),
			'activate'=>1,
			'role_id'=>1,
			'group_id'=>1,
			));
/*
|---------------------------------------------
|	profilesテーブルの作成
|---------------------------------------------
*/
	//usersテーブルの存在確認
 	if(Schema::hasTable('profiles')){
		$data['warning']='profilesテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//profilesテーブルの作成
 	Schema::create('profiles',function($table){
 		$table->increments('id');
		//usersテーブルへのリレーション用
		$table->integer('user_id')->nullable();
		//電話番号
		$table->string('tel',20)->nullable();
		//address関連情報（シリアライズ）
		$table->text('address')->nullable();
		//身体関連情報(シリアライズ)
 		$table->text('body')->nullable();
		//資格関連情報(シリアライズ)
 		$table->text('license')->nullable();
		//労務関連情報(シリアライズ)
 		$table->text('labor')->nullable();
		//家族関連情報(シリアライズ)
 		$table->text('family')->nullable();
		//その他(シリアライズ)
 		$table->text('note')->nullable();
 		//$table->integer('group_id')->nullable();
 		$table->text('profile')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//deleted_atカラムを追加
		$table->timestamp('deleted_at')->nullable();
 	});
/*
|---------------------------------------------
|	rolesテーブルの作成
|---------------------------------------------
*/
	//rolesテーブルの存在確認
 	if(Schema::hasTable('roles')){
		$data['warning']='rolesテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//rolesテーブルの作成
 	Schema::create('roles',function($table){
 		$table->increments('id');
		$table->string('name',32);
 		$table->integer('level')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//deleted_atカラムを追加
		$table->timestamp('deleted_at')->nullable();	
 	});
	//新規Roleの作成
	Role::create(array(
			'name'=>'Admin',
			'level'=>100,
			));
	Role::create(array(
			'name'=>'Manager',
			'level'=>70,
			));
	Role::create(array(
			'name'=>'Moderator',
			'level'=>50,
			));
	Role::create(array(
			'name'=>'Staff',
			'level'=>30,
			));
	Role::create(array(
			'name'=>'User',
			'level'=>1,
			));
	Role::create(array(
			'name'=>'Banned',
			'level'=>0,
			));
/*
|---------------------------------------------
|	groupsテーブルの作成
|---------------------------------------------
*/
	//groupsテーブルの存在確認
 	if(Schema::hasTable('groups')){
		$data['warning']='groupsテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//groupsテーブルの作成
 	Schema::create('groups',function($table){
 		$table->increments('id');
		//グループ略称
		$table->string('abbreviation',100);
		//グループ名(会社名・所属先)
		$table->string('name',100);
 		$table->integer('level')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//deleted_atカラムを追加
		$table->timestamp('deleted_at')->nullable();		
 	});
	//新規Groupの作成
	Group::create(array(
			'abbreviation'=>'Builwing',
			'name'=>'株式会社ビルウイング',
			'level'=>100,
			));
/*
|---------------------------------------------
|	belongs(部署・所属先)テーブルの作成
|---------------------------------------------
*/
	//belongsテーブルの存在確認
 	if(Schema::hasTable('belongs')){
		$data['warning']='belongsテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//belongsテーブルの作成
 	Schema::create('belongs',function($table){
 		$table->increments('id');
		//部署名
		$table->string('name',100)->nullable();
		$table->integer('group_id')->nullable();
		//address関連情報(シリアライズ)
 		$table->text('address')->nullable();
		//取引関連情報(シリアライズ)
 		$table->text('business')->nullable();
		//内部関連情報(シリアライズ)
 		$table->text('inside')->nullable();
		//備考情報(シリアライズ)
 		$table->text('note')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//deleted_atカラムを追加
		$table->timestamp('deleted_at')->nullable();		
 	});
		$data['warning']='全users関連の一括作成が完了しました。';
		return View::make('setup/index',$data);
	}
}
