<?php

/********* Start for define site general contants ***********/

define('PROJECT_NAME','newsportal');
define('SITE_CODE','NWP');

if (!defined('NO_REPLY_EMAIL')) define('NO_REPLY_EMAIL', 'noreply@newsportal.com');
if (!defined('SUPPORT_EMAIL')) define('SUPPORT_EMAIL', 'support@newsportal.com');
if (!defined('SITE_NAME')) define('SITE_NAME', 'News Portal');

if (!defined('TABLEPREFIX')) define('TABLEPREFIX', 'np_');


if (!defined('MAX_UPLOAD_IMAGE_SIZE')) define('MAX_UPLOAD_IMAGE_SIZE', 10000000);

if (!defined('UPLOAD_DIR')) define('UPLOAD_DIR','upload');
if (!defined('NEWS_IMAGE_UPLOAD_DIR')) define('NEWS_IMAGE_UPLOAD_DIR','news-image');

/********* End for define site general constants ***********/

?>