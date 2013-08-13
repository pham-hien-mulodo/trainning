<?php
define('DB_SERVER',        'localhost');
define('DB_USERNAME',    'root');
define('DB_PASSWORD',    '');
define('DB_DATABASE',    'php_basics');
$_connection    = mysql_pconnect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die('Not connected MySQL');
$_selecteddb    = mysql_select_db(DB_DATABASE, $_connection) or die('Not selected database');
?>