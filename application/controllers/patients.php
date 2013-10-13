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
		$this->load->helper('patients');
	}

	public function index() {
		redirect(site_url('patients/lists'));
	}

	public function add() {
		allows(array('administrator'));
		if ($this -> input -> post('data'))
			$this -> load -> view('patients/add', $this -> data);
		else {
			$this -> data['title'] = 'បង្កើត​អ្នក​ជំងឺថ្មី';
			$this -> data['doctors_data'] = $this -> m_global -> select_where(TBL_PREFEX . 'doctors',array('doc_status'=>1));
			$this -> load -> view(TEMPLATE, $this -> data);
		}
	}

	public function add_save() {
		if ($_POST) {
			$pat_first_name = $this -> input -> post('txt_patFirstName');
			$pat_last_name = $this -> input -> post('txt_patLastName');
			$pat_sex = $this -> input -> post('txt_patSex');
			$pat_email = $this -> input -> post('txt_patEmail');
			$pat_identity_card = $this -> input -> post('txt_patIdentityCard');
			$doc_reference = ($this -> input -> post('txt_docReference') == '0') ? NULL : $this -> input -> post('txt_docReference');
			$pat_status = $this -> input -> post('txt_patStatus');
			$data_insert = array(
				'pat_firstName' => $pat_first_name,
				'pat_lastName' => $pat_last_name, 
				'pat_sex' => $pat_sex,
				'pat_identityCard' => $pat_identity_card, 
				'pat_email' => $pat_email,
				'pat_doc_id' => $doc_reference, 
				'pat_status' => $pat_status
			);
			if ($this -> m_global -> insert(TBL_PREFEX . 'patients', $data_insert)) {
				$last_patient_id = $this->db->insert_id();
				$arr_patient_phone = $this->input->post('txt_patPhone');
				$arr_patient_phone = array_filter($arr_patient_phone);
				if(count($arr_patient_phone) > 0){
					$data_batch = array();
					foreach($arr_patient_phone as $value){
						array_push($data_batch,array($last_patient_id,$value));
					}
					if($this->m_global->insert_multi(TBL_PREFEX.'patients_phones',array('pat_pho_pat_id','pat_pho_number'),$data_batch)){
						$this -> session -> set_flashdata('msg_success', 'អ្នក​ជំងឺ​ថ្មី ត្រូវ​បាន​បង្កើត!');
					}else{
						$this -> session -> set_flashdata('msg_success', 'អ្នក​ជំងឺ​ថ្មី ត្រូវ​បាន​បង្កើត! ប៉ុន្តែ​មាន​បញ្ហា​ ជាមួយ​ការ​បញ្ចូល​លេខ​ទូរស័ព្ទ');
					}
				}else{
					$this -> session -> set_flashdata('msg_success', 'អ្នក​ជំងឺ​ថ្មី ត្រូវ​បាន​បង្កើត!');
				}
				if($this->session->userdata('new_patient_exam_test')){
					$this->session->set_flashdata('pat_id',$last_patient_id);
					redirect($this->session->userdata('new_patient_exam_test'));
				}
				redirect(site_url('patients/lists'));
			} else {
				echo '';
			}
		}
	}

	public function edit($id = NULL) {
		if ($id != NULL) {
			allows(array('administrator'));
			$edit_data = $this -> m_global -> select_where(TBL_PREFEX . 'patients', array('pat_id' => $id), 1);
			if (!is_numeric($id) || (count($edit_data -> result_array()) == 0)) {
				$this -> session -> set_flashdata('msg_error', 'អ្នក​ជំងឺ​ ដែល​អ្នក​កំ​ពុង​ ព្យាយាម​កែប្រែ ពុំ​មាន​នៅ​ក្នុង​ប្រ​ព័ន្ធ​ទេ!');
				redirect(site_url('patients/lists'));
			}
			$this -> data['title'] = 'កែប្រែ​អ្នក​ជំងឺ';
			$this -> data['edit_data'] = $edit_data;
			$this -> data['doctors_data'] = $this -> m_global -> select_where(TBL_PREFEX . 'doctors',array('doc_status'=>1));
			$this->data['phones_data'] = $this->m_global->select_where(TBL_PREFEX.'patients_phones',array('pat_pho_pat_id'=>$id));
			$this -> load -> view(TEMPLATE, $this -> data);
		}
	}

	public function edit_save() {
		if ($_POST) {
			$pat_id = $this -> input -> post('pat_id');
			$pat_first_name = $this -> input -> post('txt_patFirstName');
			$pat_last_name = $this -> input -> post('txt_patLastName');
			$pat_sex = $this -> input -> post('txt_patSex');
			$pat_identity_card = $this -> input -> post('txt_patIdentityCard');
			$pat_email = $this -> input -> post('txt_patEmail');
			$doc_reference = ($this -> input -> post('txt_docReference') == '0') ? NULL : $this -> input -> post('txt_docReference');
			$pat_status = $this -> input -> post('txt_patStatus');
			$data_update = array(
				'pat_firstName' => $pat_first_name,
				'pat_lastName' => $pat_last_name, 
				'pat_sex' => $pat_sex,
				'pat_identityCard' => $pat_identity_card, 
				'pat_email' => $pat_email,
				'pat_doc_id' => $doc_reference, 
				'pat_status' => $pat_status
			);
			if ($this -> m_global -> update(TBL_PREFEX . 'patients', $data_update, array('pat_id' => $pat_id))) {
				$arr_patient_phone = $this->input->post('txt_patPhone');
				$arr_patient_phone = array_filter($arr_patient_phone);
				if(count($arr_patient_phone) > 0){
					$data_batch = array();
					foreach($arr_patient_phone as $value){
						array_push($data_batch,array($pat_id,$value));
					}
					if($this->m_global->insert_multi(TBL_PREFEX.'patients_phones',array('pat_pho_pat_id','pat_pho_number'),$data_batch)){
						$this -> session -> set_flashdata('msg_success', 'អ្នក​ជំ​ងឺ​ត្រង់ id = ' . $pat_id . ' ត្រូវ​បាន​ធ្វើ​ការ​ កែប្រែ!');
					}else{
						$this -> session -> set_flashdata('msg_success', 'អ្នក​ជំ​ងឺ​ត្រង់ id = ' . $pat_id . ' ត្រូវ​បាន​ធ្វើ​ការ​ កែប្រែ! ប៉ុន្តែ​មាន​បញ្ហា​ជាមួយ ការ​បញ្ចូល​លេខ​ទូរស័ព្ទ');
					}
				}else{
					$this -> session -> set_flashdata('msg_success', 'អ្នក​ជំ​ងឺ​ត្រង់ id = ' . $pat_id . ' ត្រូវ​បាន​ធ្វើ​ការ​ កែប្រែ!');
				}
				
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
			$this -> data['title'] = 'បង្ហាញ​អ្នក​ជំងឺ';
			$this -> load -> view(TEMPLATE, $this -> data);
		}
	}
	
	//page for ajax call to remove the phone number
	public function ajax_remove_phone(){
		if($_POST){
			$id = $this->input->post('id');
			$this->db->delete(TBL_PREFEX.'patients_phones',array('pat_pho_id'=>$id));
		}
	}

}
