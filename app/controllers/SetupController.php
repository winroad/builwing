<?php
class SetupController extends BaseController{
//セットアップビューの表示
public function getIndex(){
	return View::make('setup/index');
}

/*--------------------------------------------
|	verify関連テーブルの作成
|---------------------------------------------
*/
	//prmissionsテーブルの存在確認
	public function getVerify(){
 	if(Schema::hasTable('users')){
		$data['warning']='usersテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
		
    Schema::create('permissions', function($table)
    {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name', 100)->index();
            $table->string('description', 255)->nullable();
            $table->timestamps();
        });

        // Create the roles table
        Schema::create('roles', function($table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name', 100)->index();
            $table->string('description', 255)->nullable();
            $table->integer('level');
            $table->softDeletes();
            $table->timestamps();
        });

        // Create the users table
        Schema::create('users', function($table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name', 30)->index();
            $table->string('password', 64)->index();
            $table->string('salt', 32);
            $table->string('email', 255)->index();
            $table->boolean('verified')->default(0);
            $table->boolean('disabled')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // Create the role/user relationship table
        Schema::create('role_user', function($table)
        {
            $table->engine = 'InnoDB';

            $table->integer('user_id')->unsigned()->index();
            $table->integer('role_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        // Create the permission/role relationship table
        Schema::create('permission_role', function($table)
        {
            $table->engine = 'InnoDB';

            $table->integer('permission_id')->unsigned()->index();
            $table->integer('role_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        $role_id = DB::table('roles')->insertGetId(array(
            'name' => Config::get('verify::super_admin'),
            'level' => 10,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ));

        $user_id = DB::table('users')->insertGetId(array(
            'name' => 'admin',
            'password' => '$2a$08$rqN6idpy0FwezH72fQcdqunbJp7GJVm8j94atsTOqCeuNvc3PzH3m',
            'salt' => 'a227383075861e775d0af6281ea05a49',
            'email' => 'admin@example.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'verified' => 1,
            'disabled' => 0,
        ));

        DB::table('role_user')->insert(array(
            'role_id' => $role_id,
            'user_id' => $user_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ));
		$data['warning']='全Verify関連の一括作成が完了しました。';
		return View::make('setup/index',$data);
	}

/*
|---------------------------------------------
|	profilesテーブルの作成
|---------------------------------------------
*/
public function getProfiles(){
 	if(Schema::hasTable('profiles')){
		$data['warning']='profilesテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
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
 		$table->timestamps();
		$table->timestamp('deleted_at')->nullable();
 	});
		$data['warning']='profilesテーブルを作成しました。';
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
		//$table->string('abbreviation',100);
		//グループ名(会社名・所属先)
		$table->string('name',100);
 		$table->text('permissions')->nullable();
 		$table->timestamps();
		$table->softDeletes();		
 	});
		$data['warning']='groupsテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
/*
|---------------------------------------------
|	group_userテーブルの作成
|---------------------------------------------
*/
public function getGroupUser(){
	//groupsテーブルの存在確認
 	if(Schema::hasTable('users_groups')){
		$data['warning']='users_groupsテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
 	Schema::create('users_groups',function($table){
 		$table->integer('user_id');
 		$table->integer('group_id');
	});
		$data['warning']='users_groupsテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
/*
|---------------------------------------------
|	company(部署・所属先)テーブルの作成
|---------------------------------------------
*/
public function getCompany(){
	//belongsテーブルの存在確認
 	if(Schema::hasTable('companies')){
		$data['warning']='companiesテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
	//belongsテーブルの作成
 	Schema::create('companies',function($table){
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
		$table->SoftDeletes();		
 	});
		$data['warning']='companyテーブルを作成しました。';
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
		$table->integer('user_id');
		//受信者ID（個人宛ポストの場合）
		$table->integer('recipient_id')->nullable();
		//受信RoleID
		$table->integer('role_id')->nullable();
		//タイトル
		$table->string('subject',200);
		//メッセージ内容
		$table->text('body');
		//メールチェック用
    $table->boolean('mail')->default(0);
		//コメント
		$table->text('comment')->nullable;
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
		//メッセージID
		$table->integer('message_id');
		//投稿者ID
		$table->integer('user-_id');
		//受信者ID（個人宛ポストの場合）
		$table->integer('recipient_id')->nullable();
		//RoleID（Role宛ポストの場合）
		$table->integer('role_d')->nullable();
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
		//未読メッセージの配列（シリアライズ）
		$table->text('message')->nullable();
		//未読メッセージの配列（シリアライズ）
		$table->text('comment')->nullable();
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
|	activates(アクティベーション用）テーブルの作成
|---------------------------------------------
*/
	public function getActivates(){
 	if(Schema::hasTable('activates')){
		$data['warning']='activatesテーブルが存在しますので、処理を中止します。';
		return View::make('setup/index',$data);
	}
 	Schema::create('activates',function($table){
            $table->increments('id');
            $table->string('name', 30);
            $table->string('password', 64);
            $table->string('email', 255);
            $table->integer('role_id');
            $table->string('salt', 32);
            $table->string('onepass', 64);
            $table->timestamp('limit');
            $table->timestamps();
 	});
		$data['warning']='activatesテーブルを作成しました。';
		return View::make('setup/index',$data);
	}
}
