<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function tests_step_redirect($step){
	redirect(site_url('tests/add_step'.$step));
}

function get_patient_name($id = 0){
	$CI = get_instance();
	$CI->load->model('m_global');
	return $CI->m_global->get_patient_name($id);
}
?>