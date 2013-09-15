<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of patients
 *
 * @author vannak.pen
 */
class Patients extends CI_Controller {
	var $data = null;
	public function __construct() {
		parent::__construct();
	}
	
	public function index(){
		redirect(site_url('patients/lists'));
	}

	public function add() {
		allows(array('administrator'));
		if ($this -> input -> post('data'))
			$this -> load -> view('patients/add', $this -> data);
		else {
			$this -> data['title'] = 'Add new patient';
			$this -> data['doctors_data'] = $this -> m_global -> select_all(TBL_PREFEX . 'doctors');
			$this -> load -> view(TEMPLATE, $this -> data);
		}
	}

	public function add_save() {
		if ($_POST) {
			$doc_name = $this -> input -> post('txt_docName');
			$doc_sex = $this -> input -> post('txt_docSex');
			$doc_email = $this -> input -> post('txt_docEmail');
			$doc_position = $this -> input -> post('txt_docPosition');
			$doc_hospital = $this -> input -> post('txt_docHospital');
			$doc_reference = ($this -> input -> post('txt_docReference') == '0') ? NULL : $this -> input -> post('txt_docReference');
			$doc_status = $this -> input -> post('txt_docStatus');
			$data_insert = array('doc_name' => $doc_name, 'doc_sex' => $doc_sex, 'doc_email' => $doc_email, 'doc_position' => $doc_position, 'doc_hos_id' => $doc_hospital, 'doc_reference' => $doc_reference, 'doc_status' => $doc_status);
			if ($this -> m_global -> insert(TBL_PREFEX . 'patients', $data_insert)) {
				$this -> session -> set_flashdata('msg_success', 'New patient has been created!');
				redirect(site_url('patients/lists'));
			} else {
				echo '';
			}
		}
	}

	public function edit($id = NULL) {
		if ($id != NULL) {
			allows(array('administrator'));
			$edit_data = $this -> m_global -> select_where(TBL_PREFEX . 'patients', array('doc_id' => $id), 1);
			if (!is_numeric($id) || (count($edit_data -> result_array()) == 0)) {
				$this -> session -> set_flashdata('msg_error', 'The patient you are trying to edit is not exist in our system!');
				redirect(site_url('patients/lists'));
			}
			$this -> data['title'] = 'Edit patient';
			$this -> data['edit_data'] = $edit_data;
			$this -> data['hospital_data'] = $this -> m_global -> select_all(TBL_PREFEX . 'hospitals');
			$this -> data['patients_data'] = $this -> m_global -> select_all(TBL_PREFEX . 'patients');
			$this -> load -> view(TEMPLATE, $this -> data);
		}
	}

	public function edit_save() {
		if ($_POST) {
			$doc_id = $this -> input -> post('doc_id');
			$doc_name = $this -> input -> post('txt_docName');
			$doc_sex = $this -> input -> post('txt_docSex');
			$doc_email = $this -> input -> post('txt_docEmail');
			$doc_position = $this -> input -> post('txt_docPosition');
			$doc_hospital = $this -> input -> post('txt_docHospital');
			$doc_reference = ($this -> input -> post('txt_docReference') == '0') ? NULL : $this -> input -> post('txt_docReference');
			$doc_status = $this -> input -> post('txt_docStatus');
			$data_update = array('doc_name' => $doc_name, 'doc_sex' => $doc_sex, 'doc_email' => $doc_email, 'doc_position' => $doc_position, 'doc_hos_id' => $doc_hospital, 'doc_reference' => $doc_reference, 'doc_status' => $doc_status);
			if ($this -> m_global -> update(TBL_PREFEX . 'patients', $data_update, array('doc_id' => $doc_id))) {
				$this -> session -> set_flashdata('msg_success', 'A patient at id = ' . $doc_id . ' has been updated!');
				redirect(site_url('patients/lists'));
			} else {
				echo '';
			}
		}
	}

	public function lists() {
		allows(array('administrator'));
		$this -> data['data'] = $this -> m_global -> select_all(VIE_PREFEX . 'patients');
		if ($this -> input -> post('data'))
			$this -> load -> view('patients/lists', $this -> data);
		else {
			$this -> data['title'] = 'List patients';
			$this -> load -> view(TEMPLATE, $this -> data);
		}
	}

}
