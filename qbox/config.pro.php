<?php

namespace QBox;

//
// OAuth2

const CLIENT_ID     = '<ClientId>';
const CLIENT_SECRET = '<ClientSecret>';

const REDIRECT_URI           = '<RedirectURL>';
const AUTHORIZATION_ENDPOINT = '<AuthURL>';
const TOKEN_ENDPOINT         = 'https://acc.qbox.me/oauth2/token';

//
// QBox

const PUT_TIMEOUT = 300000; // 300s = 5m

const IO_HOST = 'http://io.qbox.me';
const FS_HOST = 'https://fs.qbox.me';
const RS_HOST = 'http://rs.qbox.me:10100';

//
// Demo

const DEMO_DOMAIN = 'io.qbox.me';

// a more security path need
define("QBOX_TOKEN_TMP_FILE", sys_get_temp_dir() . DIRECTORY_SEPARATOR . '.qbox_tokens');
