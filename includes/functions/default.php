<?php
/**
 * Default functions
 */

/**
 * Converts array to object
 * @param array $arr The array to being converted
 * @param string $class_name The class name of the new object
 * @param boolean $construct Calls the constructor method
 * @return object The object
 */
function cast($arr, $class_name, $construct=false) {
	$obj = unserialize('O:'. strlen($class_name) .':"'. $class_name .'"'. substr(serialize($arr), 1));
	if ($construct && method_exists($obj, '__construct'))
		$obj->__construct();
	return $obj;
}

/**
 * Checks whether a variable is decimal (float without type)
 * @param mixed $var The variable being evaluated
 * @return boolean TRUE if var is a decimal number, FALSE otherwise
 */
function is_decimal($var) {
	return $var != (int) $var;
}

/**
 * Binary safe string comparison
 * @param string $a The first string
 * @param string $b The second string
 * @return boolean TRUE if the they are equals, FALSE otherwise
 */
function strequal($a, $b) {
	return strcamp((string) $a, (string) $b) === 0;
}

/**
 * Get the singular or plural string by count
 * @param string $singular Singular string
 * @param string $plural Plural string
 * @param int $count Count
 * @return string The singular or plural string according count
 */
function __($singular, $plural, $count) {
	return sprintf($count <= 1 ? $singular : $plural, $count);
}

/**
 * Strip accents
 * @param string $str The input string
 * @return string The string wihtout accents
 */
function unaccent($str) {
	return preg_replace('#&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml|caron);#i', '$1', htmlentities($str, ENT_QUOTES, 'UTF-8'));
}

/**
 * Sends HTTP Location header
 * @param string $location
 */
function location($location) {
	return header('Location: '. $location);
}

/**
 * Real session destroy
 */
function session_real_destroy() {
	if (ini_get('session.use_cookies')) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 4200, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
	}
	session_destroy();
	unset($_SESSION);
}

?>