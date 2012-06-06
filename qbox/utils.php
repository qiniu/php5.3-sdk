<?php

namespace QBox;

function ErrorMessage($code, $error) {

	$msg = @$error['error'];
	if (empty($msg)) {
		return "errno($code)";
	} else {
		return $msg;
	}
}

function Encode($str) // URLSafeBase64Encode
{
	$find = array("+","/");
	$replace = array("-", "_");
	return str_replace($find, $replace, base64_encode($str));
}

function CalFileCRC32Sum($filepath){
    if(function_exists('hash_file')){
        $hash = hash_file('crc32b', $filepath);
        $arrb = unpack('N', pack('H*', $hash));
        $crci = $arrb[1];
    } else {
        $data = file($filepath);
        $data = implode('', $data);
        $crci = crc32($data);
    }
    return $crci;
}
