<?php

require __DIR__ .'/Engine.php';

class DB {
	/**
	 * Current database connection
	 * @var DB
	 */
	private static $instance;
	
	/**
	 * Open a new connection to the database server
	 * @param string $engine Database engine: MySQL, Postgres, Oracle
	 * @param string $host Host name or an IP address
	 * @param string $user The user name
	 * @param string $pass The user password
	 * @param string $db If provided will specify the default database to be used when performing queries
	 * @param string $port Specifies the port number to attempt to connect to the database server
	 */
	static function connect($engine=DB_ENGINE, $host=DB_HOST, $user=DB_USER, $pass=DB_PASS, $db=DB_NAME, $port=DB_PORT) {
		require_once __DIR__ ."/{$engine}.php";
		$engine = 'DB\\'. $engine;
		return new $engine($host, $user, $pass, $db, $port);
	}
	
	/**
	 * Get the current DB connection
	 * If there is no connection, one will be created
	 * @return DB
	 */
	static function cursor() {
		if (!self::$instance)
			self::$instance = self::connect();
		return self::$instance;
	}
}

?>