<?php

namespace QBox;

//
// OAuth2

const CLIENT_ID     = '<ClientId>';
const CLIENT_SECRET = '<ClientSecret>';

const REDIRECT_URI           = '<RedirectURL>';
const AUTHORIZATION_ENDPOINT = '<AuthURL>';
const TOKEN_ENDPOINT         = 'http://127.0.0.1:9876/oauth2/token';

const TOKEN_ENDPOINT_FORMAT  = 'http://%s/oauth2/token';
const TOKEN_HOST_LIST = '127.0.0.1';
const TOKEN_HOST_PORT = '9876';

//
// QBox

const PUT_TIMEOUT = 300000; // 300s = 5m

const IO_HOST = 'http://127.0.0.1:9876';
const FS_HOST = 'http://127.0.0.1:9872';
const RS_HOST = 'http://127.0.0.1:9875';

//
// Demo

const DEMO_DOMAIN = 'localhost:9876';

// a more security path need
define("QBOX_TOKEN_TMP_FILE", sys_get_temp_dir() . DIRECTORY_SEPARATOR . '.qbox_tokens');
