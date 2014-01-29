<?php

require __DIR__ .'/Written.php';

/**
 * Abstract Writer
 */
abstract class Writer {
	/**
	 * Container of Written objects
	 * @var array
	 */
	public $objects = array();
	
	/**
	 * Container of Written objects that failed verification
	 * @var array
	 */
	public $invalids = array();
	
	/**
	 * Adds a Written object
	 * @param Written $object The Written object
	 */
	function attach(Written $object) {
		$this->objects[] = $object;
	}
	
	/**
	 * Removes a Written object
	 * @param Written $object The Written object
	 */
	function detach(Written $object) {
		$objects = array();
		foreach ($this->objects as $i)
			if ($i !== $object)
				$object[] = $i;
		$this->objects = $objects;
	}
	
	/**
	 * Checks for errors in the objects in the container.
	 * The objects that have errors are transferred to invalid's container
	 * @return boolean TRUE if any error, FALSE otherwise
	 */
	function hasError() {
		$objects = array();
		foreach ($this->objects as $i) {
			$this->verify($i);
			if (!$i->__e)
				$objects[] = $i;
			else
				$this->invalids[] = $i;
		}
		$this->objects = $objects;
		return !!$this->invalids;
	}
	
	/**
	 * Writes the objects of the container
	 */
	function write() {
		while (list(, $object) = each($this->objects))
			$this->save($object);
	}
	
	/**
	 * Abstract method of verification
	 * @param Written $object A Written object
	 */
	abstract function verify(Written $object);
	
	/**
	 * Abstract method of writing
	 * @param Written $object A Written object
	 */
	abstract function save(Written $object);
}

?>