<?php

require('rs.php');
require('client/rs.php');
require_once('upload_token.php');
require_once('wmrs.php');

$client = QBox\OAuth2\NewClient();
$bucket = 'wmbucket';
$path = getcwd();
$key = 'test.jpg';
$demo_domain = "http://io.qbox.me:13004/wmbucket";

$rs = QBox\RS\NewService($client, $bucket);


list($result, $code, $error) = $rs->setProtected(0);
echo "===> set Protected:\n";
if ($code == 200) {
	echo "set Protected success!\n";
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "set Protected code failed: $code - $msg\n";
}

list($result, $code, $error) = $rs->setSeparator("_");
echo "===> set Separator:\n";
if ($code == 200) {
	echo "set Separator success!\n";
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "set Separator failed: $code - $msg\n";
}

list($result, $code, $error) = $rs->setStyle("small.jpg", "imageView/0/w/64/h/64/watermark/0");
echo "===> set samll.jpg Style:\n";
if ($code == 200) {
	echo "set samll.jpg Style success!\n";
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "set samll.jpg Style failed: $code - $msg\n";
}

list($result, $code, $error) = $rs->setStyle("mid.jpg", "imageView/0/w/128/h/128/watermark/1");
echo "===> set mid.jpg Style:\n";
if ($code == 200) {
	echo "set mid.jpg Style success!\n";
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "set mid.jpg Style failed: $code - $msg\n";
}


$wmrs  = QBox\WMRS\NewService($client);
$wm_options = array("text"=>"defCustomer","bucket"=>$bucket, 'dx'=>20, 'dy'=>20);


list($result, $code, $error) = $wmrs->set('', $wm_options);
echo "===>set default watermark:\n";
if ($code == 200) {
	echo "set default watermark success!\n";
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "set default watermark failed: $code - $msg\n";
}

list($result, $code, $error) = $wmrs->get('');
echo "===>get default watermark\n";
if ($code == 200) {
	var_dump($result);
} else {
	$msg = QBox\ErrorMessage($code, $error);
	echo "get default watermark failed: $code - $msg\n";
}

$wm_options = array("text"=>"sepCustomer","bucket"=>$bucket, 'dx'=>30, 'dy'=>30);

list($result, $code, $error) = $wmrs->set('sepCustomer', $wm_options);
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
		"scope"        => $bucket,
		"expires_in"   => 360000,
		"callback_url" => "",
		"customer" 	   => "",
		"callbackBodyType" => ''
);

$uploadToken = \QBox\NewAuthPolicy($opts);
list($result, $code, $error) = \QBox\RS\PutFile(QBOX_UP_HOST . "/upload", $bucket, $key, 'image/jpg', $path . "/" . $key ,'' , '', $uploadToken);
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
