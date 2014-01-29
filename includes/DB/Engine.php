<?php
/**
 * Database engine interface
 */

namespace DB;

interface Engine {
	/**
	 * Performs a query and fetch first result
	 * @param string $query The query string
	 * @param string $class_name The name of the class to instantiate
	 * @return mixed The object, or FALSE on failure
	 */
	function get($query, $class_name='stdClass');
	
	/**
	 * Performs a query and fetch results returning an array containg all fetched rows
	 * @param string $query The query string
	 * @param string $class_name The name of the class to instantiate
	 * @return array An array containing all fetched rows
	 */
	function all($query, $class_name='stdClass');
}

?>