#!/usr/bin/env php
<?php

require('rs.php');
require('fileop.php');

$client = QBox\OAuth2\NewClient();

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
