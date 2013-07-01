<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
</head>
<body>
<h2>アクティベート手続き</h2>

<div>
<h3>{{ $username }}さん、ようこそ！</h3>
<p>あなたのユーザー登録申請を受け付けました。</p>
<p>下記のURLをクリックすると、新規ユーザー作成手続きが、完了します。</p>
<p>{{ URL::to('user/activate', array($onepass)) }}</p>
<p>ありがとうございました。</p>
</div>
</body>
</html>