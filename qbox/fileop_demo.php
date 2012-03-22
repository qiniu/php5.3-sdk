#!/usr/bin/env php
<?php

require('rs.php');
require('fileop.php');

$client = QBox\OAuth2\NewClient();

list($code, $result) = QBox\OAuth2\ExchangeByPasswordPermanently($client, 'test@qbox.net', 'test', QBOX_TOKEN_TMP_FILE);
if ($code != 200) {
	$msg = QBox\ErrorMessage($code, $result);
	echo "Login failed: $code - $msg\n";
	exit(-1);
}

/*
list($code, $result) = QBox\OAuth2\ExchangeByPassword($client, 'test@qbox.net', 'test');
if ($code != 200) {
	$msg = QBox\ErrorMessage($code, $result);
	echo "Login failed: $code - $msg\n";
	exit(-1);
}
*/

$tblName = 'tblName';
$rs = QBox\RS\NewService($client, $tblName);

$key = '2.jpg';

list($result, $code, $error) = $rs->Get($key, $key);
echo "===> Get $key result:\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "Get failed: $code - $msg\n";
	exit(-1);
}

$urlImageInfo = QBox\FileOp\ImageInfoURL($result['url']);

echo "===> ImageInfo of $key:\n";
echo file_get_contents($urlImageInfo) . "\n";

if (false) {
	$urlStylePreview = QBox\FileOp\StylePreviewURL($result['url'], '3.png', 'address=成都市高新区天府软件园D区D7;date=2011/03/28;duration=下午;time=23:24;message=中午没事的时候到后校门吃粽子;phonename=TAKEN BY SAMSUNG i9000');
	$jpg = file_get_contents($urlStylePreview);
	file_put_contents('2_output_s.jpg', $jpg);

	echo "===> StylePreview done and save to 2_output_s.jpg\n";
} else if (false) {
	list($result, $code, $error) = QBox\FileOp\StyleConv($client, $result['url'], '3.png', 'address=成都市高新区天府软件园D区D7;date=2011/03/28;duration=下午;time=23:24;message=中午没事的时候到后校门吃粽子;phonename=TAKEN BY SAMSUNG i9000');
	echo "===> StyleConv $key result:\n";
	if ($code == 200) {
		var_dump($result);
	} else {
		$msg = QBox\ErrorMessage($code, $error);
		echo "StyleConv failed: $code - $msg\n";
		exit(-1);
	}
}

$urlPreview = QBox\FileOp\ImageMogrURL($result['url'], 'auto-orient/thumbnail/x256/quality/80'); // 限制高度 256px; 等比例缩放
$jpg = file_get_contents($urlPreview);
file_put_contents('2_thumb_h256_s.jpg', $jpg);

echo "===> ImagePreview done and save to 2_thumb_h256_s.jpg\n";

$urlPreview = QBox\FileOp\ImageMogrURL($result['url'], 'auto-orient/thumbnail/256x/quality/80'); // 限制宽度 256px; 等比例缩放
$jpg = file_get_contents($urlPreview);
file_put_contents('2_thumb_w256_s.jpg', $jpg);

echo "===> ImagePreview done and save to 2_thumb_w256_s.jpg\n";

