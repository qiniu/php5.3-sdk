<?php

namespace QBox;

//
// OAuth2

const CLIENT_ID     = '<ClientId>';
const CLIENT_SECRET = '<ClientSecret>';

const REDIRECT_URI           = '<RedirectURL>';
const AUTHORIZATION_ENDPOINT = '<AuthURL>';
const TOKEN_ENDPOINT         = 'http://dev.qbox.us:9100/oauth2/token';

//
// QBox

const PUT_TIMEOUT = 300000; // 300s = 5m

const IO_HOST = 'http://dev.qbox.us:9200';
const FS_HOST = 'http://dev.qbox.us:9300';
const RS_HOST = 'http://dev.qbox.us:10100';

// crc32 32bit limitation
const CRC32_LIMIT_SIZE = 2147483648; // 2GB

//
// Demo

const DEMO_DOMAIN = 'dev.qbox.us:9200';

// a more security path need
define("QBOX_TOKEN_TMP_FILE", sys_get_temp_dir() . DIRECTORY_SEPARATOR . '.qbox_tokens');
