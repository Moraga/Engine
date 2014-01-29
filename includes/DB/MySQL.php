<?php
/**
 * MySQL Implementation
 */

namespace DB;

class MySQL extends \mysqli implements Engine {
	/**
	 * Open a new connection to the MySQL server
	 * @param string $host Host name or an IP address
	 * @param string $user The MySQL user name
	 * @param string $pass The MySQL user password
	 * @param string $db If provided will specify the default database to be used when performing queries
	 * @param string $port Specifies the port number to attempt to connect to the MySQL server
	 */
	function __construct($host, $user, $pass, $db, $port) {
		parent::__construct($host, $user, $pass, $db, $port);
	}
	
	function get($query, $class_name='stdClass') {
		return ($result = $this->query($query)) ? ($class_name ? $result->fetch_object($class_name) : $result->fetch_assoc()) : false;
	}
	
	function all($query, $class_name='stdClass') {
		$rows = array();
		if ($result = $this->query($query))
			while ($row = $result->fetch_object($class_name))
				$rows[] = $row;
		return $rows;
	}
}

?>