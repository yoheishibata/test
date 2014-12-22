<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>PHPテスト</title>
</head>
<body>

<h1>PHPのテストです</h1>

<p>
今日の日付は
<?php
echo date('Y年m月d日');
?>
です。
</p>

</body>
</html>

<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
require_once("Mail.php");

mb_language("ja");
mb_internal_encoding("UTF-8");

// SMTP 接続設定
$settings = array(
	"host"		=> "ssl://smtp.gmail.com",
	"port"		=> "465",
	"auth"		=> true,
	"username"	=> "middlename.mxpx",
	"password"	=> "middlename",
	"debug"		=> false
);

//$to_address = "n0b9f8bgxmrjhbct121v@docomo.ne.jp";
$to_address = "strike-eagle.15@y3.dion.ne.jp";
$from_address = "test@gmail.com";

$subject = "Gmail(SSL/465)を使ってPHPでメールを送る";
$subject = mb_encode_mimeheader( mb_convert_encoding($subject,"iso-2022-jp") );

$to_header =  mb_encode_mimeheader( mb_convert_encoding("宛先","iso-2022-jp") ) . " <{$to_address}>";
$from_header =  mb_encode_mimeheader( mb_convert_encoding("差出人","iso-2022-jp") ) . " <{$from_address}>";

// メールヘッダー
$headers = array(
	"To"		=> $to_header,
	"From"		=> $from_header,
	"Subject"	=> $subject
);

$body="うんこ";
$body = mb_convert_encoding($body,"iso-2022-jp");

$smtp = Mail::factory("smtp", $settings);

$iteration = 50;

// 送信
for ($i =  1; $i < $iteration; $i++) {
	$result = $smtp->send(
		$to_address,
		$headers,
		$body );

	if ( PEAR::isError($result) ) {
		print "メール送信エラー：" . $result->getMessage();
	}
}

?>
