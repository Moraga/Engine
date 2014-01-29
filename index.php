<?php

require __DIR__  .'/settings.php';
require INCLUDES .'DB/DB.php';
require INCLUDES .'Writer/Writer.php';
require INCLUDES .'functions/default.php';
require INCLUDES .'functions/template.php';

// connect to database server
$db = DB::cursor();

// application URLs
$urls = [
	// url	=> file . function
	
];

// request without base URL
$request = substr($_SERVER['REQUEST_URI'], strlen(URL));

// remove query string
if ($_SERVER['QUERY_STRING'])
	$request = strstr($request, '?', true);

// handler
foreach ($urls as $url => $callback) {
	if (preg_match('#^'. $url .'$#', $request, $args)) {
		$callback = explode('.', $callback);
		require INCLUDES . $callback[0] .'.php';
		call_user_func_array($callback[1], $args);
		exit;
	}
}

// throws 404
header('HTTP/1.0 404 Not Found');
exit('404 Not Found');

?>