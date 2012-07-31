<?php

require('rs.php');
require('client/rs.php');
require_once('upload_token.php');
require_once('wmrs.php');

$client = QBox\OAuth2\NewClient();
$tblName = 'tblName';
$path = getcwd();
$key = 'test.jpg';
$demo_domain = "iovip.qbox.me/tblName";

$rs = QBox\RS\NewService($client, $tblName);


list($result, $code, $error) = $rs->setProtected(1);
echo "===> Set Protected code:$code\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "Set Protected code failed: $code - $msg\n";
}

list($result, $code, $error) = $rs->setSeparator("_");
echo "===> Set Separator\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "Set Separator failed: $code - $msg\n";
}

list($result, $code, $error) = $rs->setStyle("wfsmall.jpg", "imageView/0/w/64/h/64/watermark/0");
echo "===> Set samll.jpg Style\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "Set samll.jpg Style failed: $code - $msg\n";
}

list($result, $code, $error) = $rs->setStyle("wfmid.jpg", "imageView/0/w/128/h/128/watermark/1");
echo "===> Set mid.jpg Style：\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "Set mid.jpg Style failed: $code - $msg\n";
}


$wmrs  = QBox\WMRS\NewService($client);
$params = array("text"=>"defCustomer", 'dx'=>20, 'dy'=>20);


list($result, $code, $error) = $wmrs->set('', $params);
echo "===>set default watermark:\n";
if ($code == 200) {
	echo "set default watermark success!\n";
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "set default watermark failed: $code - $msg\n";
}

list($result, $code, $error) = $wmrs->get('');
echo "===>get default watermark：\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "get default watermark failed: $code - $msg\n";
}

$params = array("text"=>"sepCustomer", 'dx'=>30, 'dy'=>30);

list($result, $code, $error) = $wmrs->set('sepCustomer', $params);
echo "===>set sepCustomer watermark:\n";
if ($code == 200) {
	echo "set sepCustomer watermark success!\n";
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "set sepCustomer watermark: $code - $msg\n";
}
list($result, $code, $error) = $wmrs->get('sepCustomer');
echo "===>get sepCustomer watermark:\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "get sepCustomer watermark failed: $code - $msg\n";
}


//upload a picture
$opts = array(
		"scope"        => "tblName",
		"expires_in"   => 3600,
		"callback_url" => "",
		"customer" 	   => "wf",
		"callbackBodyType" => ''
);

$uploadToken = \QBox\NewAuthPolicy($opts);
list($result, $code, $error) = \QBox\RS\PutFile(QBOX_UP_HOST . "/upload", "tblName", $key, 'image/jpg', $path . "/" . $key ,'' , '', $uploadToken);
echo "===> PutFile $key result:\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "PutFile failed: $code - $msg\n";
}

echo "===>publish $demo_domain:\n";
list($code, $error) = $rs->Publish($demo_domain);
if ($code == 200) {
	echo "Publish ok!\n";
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "Publish failed: $code - $msg\n";
}
