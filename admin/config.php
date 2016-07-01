<?php
// HTTP
$configbase_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off") ? "https" : "http");
$configbase_url .= "://".$_SERVER['HTTP_HOST'];
$configbase_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

define('HTTP_SERVER', ''.$configbase_url.'');

define('HTTP_CATALOG', ''.str_replace('admin/','',$configbase_url).'');

// HTTPS
define('HTTPS_SERVER', ''.$configbase_url.'');

define('HTTPS_CATALOG', ''.str_replace('admin/','',$configbase_url).'');

// DIR
define('DIR_APPLICATION', '/var/www/html/drw/trunk/admin/');
define('DIR_SYSTEM', '/var/www/html/drw/trunk/system/');
define('DIR_DATABASE', '/var/www/html/drw/trunk/system/database/');
define('DIR_LANGUAGE', '/var/www/html/drw/trunk/admin/language/');
define('DIR_TEMPLATE', '/var/www/html/drw/trunk/admin/view/template/');
define('DIR_CONFIG', '/var/www/html/drw/trunk/system/config/');
define('DIR_IMAGE', '/var/www/html/drw/trunk/image/');
define('DIR_CACHE', '/var/www/html/drw/trunk/system/cache/');
define('DIR_DOWNLOAD', '/var/www/html/drw/trunk/download/');
define('DIR_LOGS', '/var/www/html/drw/trunk/system/logs/');
define('DIR_CATALOG', '/var/www/html/drw/trunk/catalog/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'nitaarjint111085');
define('DB_DATABASE', 'drskincare');
define('DB_PREFIX', 'oc_');
?>