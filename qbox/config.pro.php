<?php

namespace QBox;

//
// OAuth2

const CLIENT_ID     = 'abcd0c7edcdf914228ed8aa7c6cee2f2bc6155e2';
const CLIENT_SECRET = 'fc9ef8b171a74e197b17f85ba23799860ddf3b9c';

const REDIRECT_URI           = '<RedirectURL>';
const AUTHORIZATION_ENDPOINT = '<AuthURL>';
const TOKEN_ENDPOINT         = 'http://m1.qbox.me:13001/oauth2/token';

const KEY    = 'vlI2jmq_1qcmglMbXHxsCs21eVvkBDydTONPPLZA';
const SECRET = 'd9c8ewMD6kxXGI7lT2TAtb05m-QE3wJyppwIyHt_';
//
// QBox

const PUT_TIMEOUT = 300000; // 300s = 5m

const IO_HOST = 'http://m1.qbox.me:13004';
const FS_HOST = 'https://fs.qbox.me';
const RS_HOST = 'http://m1.qbox.me:13003';
//const RS_HOST = 'http://rs.qbox.me:10100';

//
// Demo

const DEMO_DOMAIN = 'ionode-my1.qbox.me';

// a more security path need
define("QBOX_TOKEN_TMP_FILE", sys_get_temp_dir() . DIRECTORY_SEPARATOR . '.qbox_tokens');
