<?php

/*********** Start for path define constants ***********/

//--------- start for absolute path -----------//

if (!defined('ABSOLUTE_PATH')) define('ABSOLUTE_PATH', $_SERVER['DOCUMENT_ROOT'].'/'.PROJECT_NAME.'/');


if (!defined('UPLOAD_PATH')) define( 'UPLOAD_PATH',ABSOLUTE_PATH.UPLOAD_DIR.'/');
if (!defined('NEWS_IMAGE_UPLOAD_PATH')) define( 'NEWS_IMAGE_UPLOAD_PATH',UPLOAD_PATH.NEWS_IMAGE_UPLOAD_DIR.'/');


//--------- end for absolute path -----------//


if (!defined('ABSOLUTE_URL')) define('ABSOLUTE_URL',"http://" .$_SERVER['HTTP_HOST'].'/'.PROJECT_NAME.'/');




if (!defined('UPLOAD_URL')) define( 'UPLOAD_URL',ABSOLUTE_URL.UPLOAD_DIR.'/');
if (!defined('NEWS_IMAGE_UPLOAD_URL'))  define( 'NEWS_IMAGE_UPLOAD_URL',UPLOAD_URL.NEWS_IMAGE_UPLOAD_DIR.'/');

/*********** End for path define constants ***********/

?>