<?php
/**
 * Template functions
 */

/**
 * Template
 * @param string $filename
 * @param array $vars Template variables
 */
function template($template, $vars=array()) {
	// default variables
	//global $a, $b, ..., $n;
	
	extract($vars);
	ini_set('include_path', DIR .'templates/'); 
	include TEMPLATES . $template;
}

/**
 * Creates a HTML select element from an array or Search instance
 * @param array|Search Values
 * @param string $name The HTML select name
 * @param mixed $value Selected values
 * @param mixed $empty Creates a option tag without value
 * @param string $attr HTML attributes
 * @return string The HTML select element
 */
function html_select($items, $name=null, $value=null, $empty=true, $attr=null) {
	$ret = '';
	
	// comparison function
	$equal = is_array($value) ? 'in_array' : 'strequal';
	
	// array
	if (is_array($items)) {
		// objects container
		if (is_object(current($items))) {
			$key = isset(current($items)->id) ? 'id' : 'name';
			$lbl = isset(current($items)->label) ? 'label' : 'name';
			
			foreach ($items as $item) {
				$ret .= '<option value="'. $item->$key .'"'. ($equal($item->$key, $value) ? ' selected="selected"' : '') .'>'. $item->$lbl .'</option>';
			}
		}
		// key => value
		else {
			foreach ($items as $key => $lbl) {
				$ret .= '<option value="'. $key .'"'. ($equal($key, $value) ? ' selected="selected"' : '') .'>'. $lbl .'</option>';
			}
		}
	}
	// instance of Search
	elseif ($items instanceof Search) {
		while ($item = $items->fetch())
			$ret .= '<option value="'. $item->id .'"'. ($equal($item->id, $value) ? ' selected="selected"' : '') .'>'. $item->name .'</option>';
	}
	
	return
		'<select'.
			($name ? ' name="'. $name .'"' : '').
			($attr ? ' '. $attr : '').
			(substr($name, -2) == '[]' && strpos($attr, '[]') == -1 ? ' multiple="multiple"' : '').
		'>'.
			($empty ? '<option>'. ($empty !== true ? $empty : '') .'</option>' : '').
			$ret.
		'</select>';	
}

/**
 * Creates a HTML checkboxes from an array or Search instance
 * @param string $name The HTML input checkbox name
 * @param array|Search Values
 * @param string $name The checkbox name
 * @param mixed $value Checked values
 * @return string The HTML checkboxes
 */
function html_checkbox($items, $name=null, $value=null) {
	$ret = '';
	
	// comparison function
	$equal = is_array($value) ? 'in_array' : 'strequal';
	
	// array
	if (is_array($items)) {
		// objects container
		if (is_object(current($items))) {
			$key = isset(current($items)->id) ? 'id' : 'name';
			$lbl = isset(current($items)->label) ? 'label' : 'name';
		
			foreach ($items as $item) {
				$ret .= '<label><input type="checkbox" name="'. $name .'" value="'. $item->$key .'"'. ($equal($item->$key, $value) ? ' checked="checked"' : '') .'/> '. $item->$lbl .'</label> ';
			}
		}
		// key => value
		else {
			foreach ($items as $key => $lbl) {
				$ret .= '<label><input type="checkbox" name="'. $name .'" value="'. $key .'"'. ($equal($key, $value) ? ' checked="checked"' : '') .'/>'. $lbl .'</label> ';
			}
		}
	}
	// instance of Search
	elseif ($items instanceof Search) {
		$key = null;
		$lbl = null;
		
		while ($item = $items->fetch()) {
			if (!$key) {
				$key = isset($item->id) ? 'id' : 'name';
				$lbl = isset($item->label) ? 'label' : 'name';
			}
			
			$ret .= '<label><input type="checkbox" name="'. $name .'" value="'. $item->$key .'"'. ($equal($item->$key, $value) ? ' checked="checked"' : '') .'/>'. $item->$lbl .'</label>';
		}
	}
	
	return $ret;
}

?>