<?php

namespace QBox\RS;

require_once('curl.php');

/**
 * func PutFile(url, key, mimeType, localFile, customMeta, callbackParams string) => (data PutRet, code int, err Error)
 * 匿名上传一个文件(上传用的临时 url 通过 $rs->PutAuth 得到)
 */
function PutFile($url, $tblName, $key, $mimeType, $localFile, $customMeta = '', $callbackParams = '', $upToken = '') {

	if ($mimeType === '') {
		$mimeType = 'application/octet-stream';
	}
	$entryURI = $tblName . ':' . $key;
	$action = '/rs-put/' . \QBox\Encode($entryURI) . '/mimeType/' . \QBox\Encode($mimeType);
	if ($customMeta !== '') {
		$action .= '/meta/' . \QBox\Encode($customMeta);
	}
	$params = array('action' => $action, 'file' => "@$localFile");
	if ($callbackParams !== '') {
		if (is_array($callbackParams)) {
			$callbackParams = http_build_query($callbackParams);
		}
		$params['params'] = $callbackParams;
	}
	 
	if ($upToken != '') {
		$params['auth'] = $upToken;
	}

	$response = \QBox\ExecuteRequest($url, $params, \QBox\HTTP_METHOD_POST);

	$code = $response['code'];
	if ($code === 200) {
		return array($response['result'], 200, null);
	}
	return array(null, $code, $response['result']);
}

