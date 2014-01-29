<?php

// Admin
define('ADMIN_NAME' , 'Your name');
define('ADMIN_EMAIL', 'Your@Email');

// Database connection
define('DB_ENGINE', 'MySQL');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', '');
define('DB_PORT', NULL);

// Directories
define('DIR', __DIR__ .'/');
define('INCLUDES', DIR .'includes/');
define('TEMPLATES', DIR .'templates/');

// URLs
define('URL', substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/') + 1));

// Timezone & Locale
ini_set('date.timezone', 'America/Sao_Paulo');
ini_set('default_charset', 'utf-8');
setlocale(LC_ALL, 'pt_BR.utf8'); // defaults to portuguese
setlocale(LC_NUMERIC, 'en_US.utf8'); // overrides previous

?>