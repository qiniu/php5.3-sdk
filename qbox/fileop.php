<?php

namespace QBox\FileOp;

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

