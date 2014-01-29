<?php
/**
 * Written object
 */
class Written {
	/**
	 * Container of errors
	 * @var array
	 */
	public $__e = array();
	
	/**
	 * Saves the object
	 * @param boolean $checkError Determines whether errors should be checked
	 * @param string $prefix Writer class prefix. Defaults to DB
	 * @return boolean TRUE on success or FALSE on failure
	 */
	function save($checkError=true, $prefix='DB') {
		$writerClass = get_class($this);
		$writerClass = (($lp = strrpos($writerClass, '_')) !== false) ?
			substr($writerClass, 0, $lp + 1) . $prefix . substr($writerClass, $lp + 1) . 'Writer' :
			$prefix . $writerClass . 'Writer';
		$writer = new $writerClass;
		$writer->attach($this);
		if ($checkError && $writer->hasError())
			return false;
		$writer->write();
		return true;
	}
	
	/**
	 * Get or set error
	 * @param string $key Error key
	 * @param mixed $value Optional error value
	 * @return mixed The error, or FALSE
	 */
	function err($key, $value=null) {
		if ($value === null)
			return isset($this->__e[$key]) ? $this->__e[$key] : false;
		else
			$this->__e[$key] = $value;
	}
	
	/**
	 * Get/print error
	 * @param string $key Error key
	 * @param string $format Format: 'the error is %s'
	 * @param boolean $echo Automatically echoes the error
	 */
	function e($key, $format=null, $echo=true) {
		// default format
		if ($format === null)
			$format = '<p class="err">%s</p>';
		
		$echo = $echo ? 'printf' : 'sprintf';
		
		// get first error
		if ($key === true)
			$key = key($this->__e);
		
		if (isset($this->__e[$key]))
			return $echo($format, $this->__e[$key]);
	}
}

?>