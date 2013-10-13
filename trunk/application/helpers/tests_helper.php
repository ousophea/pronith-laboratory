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

function get_patient_sex($id = 0){
	$CI = get_instance();
	$CI->db->where('pat_id',$id);
	$CI->db->limit(1);
	$query_select = $CI->db->get(TBL_PREFEX.'patients');
	$query_select = $query_select->result_array();
	if(count($query_select) > 0){
		return ($query_select[0]['pat_sex']=='m')?'ប្រុស':'ស្រី';
	}else{
		return 'គ្មាន';
	}
}
?>