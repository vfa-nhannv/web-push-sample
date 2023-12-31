<!DOCTYPE html>
<html lang="ja">
<head>
	<title>WebPushテスト</title>

	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width,initial-scale=1'>

	<!-- アドレスバー等のブラウザのUIを非表示 -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<!-- default（Safariと同じ） / black（黒） / black-translucent（ステータスバーをコンテンツに含める） -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!-- ホーム画面に表示されるアプリ名 -->
	<meta name="apple-mobile-web-app-title" content="WebPusher">
	<!-- ホーム画面に表示されるアプリアイコン -->
	<link rel="apple-touch-icon" href="icon-152x152.png">

	<!-- ウェブアプリマニフェストの読み込み -->
	<link rel="manifest" href="manifest.json">

	<link rel='icon' type='image/png' href='favicon.png'>

    <script defer src='service-worker.js'></script>
    <script src='webpush.js'></script>
</head>

<body>

    <a href="javascript:allowWebPush()">WebPushを許可する</a>
	<h3>サブスクリプション情報</h3>
	<pre id="subscription"></pre>
</body>
</html>