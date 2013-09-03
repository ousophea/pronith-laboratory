<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function segment($uri = 1){
		$lmp =& get_instance();
		return $lmp->uri->segment($uri);
	}
?>