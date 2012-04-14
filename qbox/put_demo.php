#!/usr/bin/env php
<?php

require('rs.php');
require('client/rs.php');

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

$key = 'put_demo.php';
$localFile = __FILE__;

list($result, $code, $error) = $rs->PutAuth();
echo "===> PutAuth result:\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "PutFile failed: $code - $msg\n";
	exit(-1);
}

list($result, $code, $error) = QBox\RS\PutFile($result['url'], $tblName, $key, '', $localFile, '', array('key' => $key));
echo "===> PutFile $key result:\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "PutFile failed: $code - $msg\n";
	exit(-1);
}

list($result, $code, $error) = $rs->Stat($key);
echo "===> Stat $key result:\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "Stat failed: $code - $msg\n";
	exit(-1);
}

