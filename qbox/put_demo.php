#!/usr/bin/env php
<?php

require('rs.php');
require('client/rs.php');

$client = QBox\OAuth2\NewClient();

$tblName = 'tblName';
$rs = QBox\RS\NewService($client, $tblName);

$key = '2.jpg';
$localFile = '2.jpg';

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

