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
		//権限管理ID
 		$table->integer('role_id')->nullable();
		//グループ管理ID
 		$table->integer('group_id')->nullable();
		//プロフィールID
 		$table->integer('profile_id')->nullable();
		//労務管理ID
 		$table->integer('work_id')->nullable();
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
	//profilesテーブルの存在確認
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
 		$table->text('work')->nullable();
		//家族関連情報(シリアライズ)
 		$table->text('family')->nullable();
		//その他(シリアライズ)
 		$table->text('note')->nullable();
		//メッセージ(シリアライズ)......未読メッセージ用
 		$table->text('message')->nullable();
		//TODO(シリアライズ)......未処理TODO用
 		$table->text('todo')->nullable();
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
			'level'=>90,
			));
	Role::create(array(
			'name'=>'Moderator',
			'level'=>80,
			));
	Role::create(array(
			'name'=>'Staff',
			'level'=>50,
			));
	Role::create(array(
			'name'=>'Outsourcing',
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
		$table->string('name',50)->unique();
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
|	histories(履歴)テーブルの作成
|---------------------------------------------
|	履歴管理のテーブル
*/
	public function getHistories(){
	//historiesテーブルの存在確認
 	if(Schema::hasTable('histories')){
		$data['warning']='historiesテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//historiesテーブルの作成
 	Schema::create('histories',function($table){
 		$table->increments('id');
		//更新者ID
		$table->integer('user_id');
		//プロフィーID
		$table->integer('profile_id');
		//更新項ID
		$table->integer('item_id');
		//更新前データ
		$table->text('old');
		//更新後データ
		$table->text('new');
		//更新理由
		$table->text('reason')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//ソフトデリート用
		$table->softDeletes();	
 	});
		$data['warning']='historiesテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
/*
|---------------------------------------------
|	tables(テーブル管理用)テーブルの作成
|---------------------------------------------
|	テーブル管理用のテーブル
*
	public function getTables(){
	//tablesテーブルの存在確認
 	if(Schema::hasTable('tables')){
		$data['warning']='tablesテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//categoriesテーブルの作成
 	Schema::create('tables',function($table){
 		$table->increments('id');
		//テーブル名
		$table->string('name',100);
		//テーブルの説明
		$table->text('description')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//ソフトデリート用
		$table->softDeletes();	
 	});
	//基本テーブルの作成
	Table::create(array(
		'name'=>'users',
		));
	Table::create(array(
		'name'=>'profiles',
		));
	Table::create(array(
		'name'=>'groups',
		));
	Table::create(array(
		'name'=>'belongs',
		));
	
		$data['warning']='tablesテーブルを作成しました。';
		return View::make('setup/index',$data);
	}*/
		
/*
|---------------------------------------------
|	history_profileピポットテーブルの作成
|---------------------------------------------
|	HistoryとProfileテーブル管理用のテーブル
*/
	public function getHistoryProfile(){
	//history_profilesテーブルの存在確認
 	if(Schema::hasTable('history_profile')){
		$data['warning']='history_profileテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//history_categoryテーブルの作成
 	Schema::create('history_profile',function($table){
 		$table->increments('id');
		//更新履歴
		$table->integer('history_id');
		//テーブル
		$table->integer('profile_id');
		//ソフトデリート用
		$table->softDeletes();	
 	});
		$data['warning']='history_profileピポットテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
	
/*
|---------------------------------------------
|	posts(投稿)テーブルの作成
|---------------------------------------------
*/
	public function getPosts(){
 	if(Schema::hasTable('posts')){
		$data['warning']='postsテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
 	Schema::create('posts',function($table){
 		$table->increments('id');
		//投稿者ID
		$table->integer('submitter_id');
		//受信者ID（個人宛ポストの場合）
		$table->integer('recipient_id')->nullable();
		//受信グループID
		$table->integer('group_id')->nullable();
		//受信RoleID
		$table->integer('role_id')->nullable();
		//表題
		$table->string('subject',200);
		//投稿内容
		$table->text('body');
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//ソフトデリート用
		$table->softDeletes();	
 	});
		$data['warning']='postsテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
/*
|---------------------------------------------
|	comments(コメント)テーブルの作成
|---------------------------------------------
*/
	public function getComments(){
 	if(Schema::hasTable('comments')){
		$data['warning']='commentsテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
 	Schema::create('comments',function($table){
 		$table->increments('id');
		//投稿者ID
		$table->integer('submitter_id');
		//受信者ID（個人宛ポストの場合）
		$table->integer('recipient_id');
		//コメント内容
		$table->text('body');
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//ソフトデリート用
		$table->softDeletes();	
 	});
		$data['warning']='commentsテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
/*
|---------------------------------------------
|	comment_postテーブルの作成
|---------------------------------------------
*/
	public function getCommentPost(){
 	if(Schema::hasTable('comment_post')){
		$data['warning']='comment_postテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
 	Schema::create('comment_post',function($table){
 		$table->increments('id');
		//ポストID
		$table->integer('post_id');
		//コメントID
		$table->integer('comment_id');
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//ソフトデリート用
		$table->softDeletes();	
 	});
		$data['warning']='comment_postテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
	
/*
|---------------------------------------------
|	works(労務管理）テーブルの作成
|---------------------------------------------
*/
	public function getWorks(){
 	if(Schema::hasTable('works')){
		$data['warning']='worksテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
 	Schema::create('works',function($table){
 		$table->increments('id');
		//ユーザーID
		$table->integer('user_id');
		//未読メッセージの配列（シリアライズ）
		$table->text('message')->nullable();
		//未処理TODOの配列（シリアライズ）
		$table->text('todo')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//ソフトデリート用
		$table->softDeletes();	
 	});
		$data['warning']='worksテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
	
/*
|---------------------------------------------
|	TODOテーブルの作成
|---------------------------------------------
*/
	public function getTodo(){
 	if(Schema::hasTable('todo')){
		$data['warning']='todosテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
 	Schema::create('todo',function($table){
 		$table->increments('id');
		//ユーザーID
		$table->integer('user_id');
		//TODOのカテゴリ
		$table->integer('category_id');
		//TODOのタイトル
		$table->string('title',200);
		//仕事詳細
		$table->text('body');
		//期日
		$table->date('deadline')->nullable();
		//完了日
		$table->date('complete')->nullable();
		//メモ
		$table->text('memo')->nullable();
		//重要度(1～10の数値で重要度を表す）
		$table->smallInteger('priority')->nullable();
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//ソフトデリート用
		$table->softDeletes();	
 	});
		$data['warning']='todoテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
/*
|---------------------------------------------
|	messagesテーブルの作成
|---------------------------------------------
*/
	public function getMessages(){
 	if(Schema::hasTable('messages')){
		$data['warning']='messagesテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
 	Schema::create('messages',function($table){
 		$table->increments('id');
		//送信者ID
		$table->integer('sender_id');
		//受信者ID（個人宛ポストの場合）
		$table->integer('recipient_id')->nullable();
		//受信RoleID
		$table->integer('role_id')->nullable();
		//タイトル
		$table->string('subject',200);
		//メッセージ内容
		$table->text('body');
 		//created_atとupdated_atの同時作成
 		$table->timestamps();
		//ソフトデリート用
		$table->softDeletes();	
 	});
		$data['warning']='messagesテーブルを作成しました。';
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
 		$table->text('work')->nullable();
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
