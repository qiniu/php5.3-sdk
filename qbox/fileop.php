<?php

namespace QBox\FileOp;

/**
 * func MakeStyleURL(url string, templPngFile string, params string, quality int) => (urlMakeStyle string)
 * 过时函数。应该改调用 StylePreviewURL 方法。
 */
function MakeStyleURL($url, $templPngFile, $params, $quality = 85) {
	return $url . '/stylePreview/' . \QBox\Encode($templPngFile) . '/params/' . \QBox\Encode($params) . '/quality/' . $quality;
}

/**
 * func StylePreviewURL(url string, templPngFile string, params string, quality int) => (urlStylePreview string)
 */
function StylePreviewURL($url, $templPngFile, $params, $quality = 85) {
	return $url . '/stylePreview/' . \QBox\Encode($templPngFile) . '/params/' . \QBox\Encode($params) . '/quality/' . $quality;
}

/**
 * func StyleConv(conn, url string, templPngFile string, params string, quality int) => (ret StyleConvRet, code int, err Error)
 */
function StyleConv($conn, $url, $templPngFile, $params, $quality = 85) {
	$urlStyleConv = $url . '/styleConv/' . \QBox\Encode($templPngFile) . '/params/' . \QBox\Encode($params) . '/quality/' . $quality;
	return \QBox\OAuth2\Call($conn, $urlStyleConv);
}

/**
 * func ImageMogrURL(url string, param string) => (urlImageMogr string)
 */
function ImageMogrURL($url, $param) {
	return $url . '/imageMogr/' . $param;
}

/**
 * func ImagePreviewURL(url string, thumbType int) => (urlImagePreview string)
 */
function ImagePreviewURL($url, $thumbType) {
	return $url . '/imagePreview/' . $thumbType;
}

/**
 * func ImageInfoURL(url string) => (urlImageInfo string)
 */
function ImageInfoURL($url) {
	return $url . '/imageInfo';
}

