#!/usr/bin/env php
<?php

require('rs.php');
require('client/rs.php');

$client = QBox\OAuth2\NewClient();

$tblName = 'tblName';
$rs = QBox\RS\NewService($client, $tblName);

$key = '010-default';
$friendName = 'rs_demo.php';

$key2 = '010-default2';
$friendName2 = 'rs_demo2.php';

if (false) {
	list($result, $code, $error) = $rs->PutFile($key, '', __FILE__);
	echo "===> PutFile result:\n";
	if ($code == 200) {
		var_dump($result);
	} else {
		$msg = QBox\ErrorMessage($code, $error);
		echo "PutFile failed: $code - $msg\n";
		exit(-1);
	}
	exit(-1);
	list($result, $code, $error) = $rs->PutFile($key2, '', __FILE__);
} else {
	list($result, $code, $error) = $rs->PutAuth();
	echo "===> PutAuth result:\n";
	if ($code == 200) {
		var_dump($result);
	} else {
		$msg = QBox\ErrorMessage($code, $error);
		echo "PutAuth failed: $code - $msg\n";
		exit(-1);
	}

	list($result, $code, $error) = QBox\RS\PutFile($result['url'], $tblName, $key, '', __FILE__, 'CustomData', array('key' => $key));
	echo "===> PutFile $key result:\n";
	if ($code == 200) {
		var_dump($result);
	} else {
		$msg = QBox\ErrorMessage($code, $error);
		echo "PutFile failed: $code - $msg\n";
		exit(-1);
	}

	list($result, $code, $error) = $rs->PutAuth();
	list($result, $code, $error) = QBox\RS\PutFile($result['url'], $tblName, $key2, '', __FILE__, 'CustomData', array('key' => $key2));
}

list($code, $error) = $rs->Publish(QBox\DEMO_DOMAIN);
echo "===> Publish result:\n";
if ($code == 200) {
	echo "Publish ok!\n";
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "Publish failed: $code - $msg\n";
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

list($result, $code, $error) = $rs->Get($key, $friendName);
echo "===> Get $key result:\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "Get failed: $code - $msg\n";
	exit(-1);
}

list($result, $code, $error) = $rs->BatchGet(array($key, $key2));
echo "===> BatchGet $key result:\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "BatchGet failed: $code - $msg\n";
	exit(-1);
}

list($result, $code, $error) = $rs->BatchGet(array(array("key" => "xxxxx", "attName" => $friendName), array("key" => $key2, "attName" => $friendName2, "expires" => 604835)));
echo "===> BatchGet $key result:\n";
if ($code == 298) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "BatchGet failed: $code - $msg\n";
	exit(-1);
}

list($result, $code, $error) = $rs->GetIfNotModified($key, $friendName, $result['hash']);
echo "===> GetIfNotModified $key result:\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "GetIfNotModified failed: $code - $msg\n";
	exit(-1);
}

echo "===> Display $key contents:\n";
echo file_get_contents($result['url']);

$action = '';
if ($action == 'delete') {
	list($code, $error) = $rs->Delete($key);
	echo "===> Delete $key result:\n";
	if ($code == 200) {
		echo "Delete ok!\n";
	} else {
		$msg = QBox\ErrorMessage($code, $error);
		echo "Delete failed: $code - $msg\n";
	}
} else if ($action == 'drop') {
	list($code, $error) = $rs->Drop();
	echo "===> Drop table result:\n";
	if ($code == 200) {
		echo "Drop ok!\n";
	} else {
		$msg = QBox\ErrorMessage($code, $error);
		echo "Drop failed: $code - $msg\n";
	}
}

