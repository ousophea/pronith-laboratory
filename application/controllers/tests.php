<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of patient test
 *
 * @author vannak.pen
 */
class Tests extends CI_Controller {
	var $data = null;
	public function __construct() {
		parent::__construct();
		$this->load->helper('tests');
		$this->load->model('m_tests');
	}
	
	public function index(){
		redirect(site_url('tests/lists'));
	}
	
	public function add_step1(){
		allows(array('administrator'));
		if(!$this->session->flashdata('back')){
			if(!$this->session->userdata('step')){
				$this->session->set_userdata('step',1);
			}
			if($this->session->userdata("step") == 0 || $this->session->userdata("step") == 1){
				$this->session->set_userdata('step',1);
			}else{
				$this->session->set_flashdata('msg_error','You are continue to add patient test in this step.<br/>If you want to create new patient test, please click on button "Cancel" to restart your task.');
				tests_step_redirect($this->session->userdata('step'));
			}
		}else{
			$this->session->set_userdata('step',1);
		}
        if($this->input->post('data'))
            $this->load->view('tests/add',  $this->data);
        else{
            $this->data['title'] = 'បង្កើត​តេស្ថថ្មី ដំណាក់​កាល​ទី១';
			$this->data['patients_data'] = $this->m_global->select_all(TBL_PREFEX.'patients');
			$this->data['ills_data'] = $this->m_tests->ill_lists();
            $this->load->view(TEMPLATE,  $this->data);
        }
	}
	
	public function add_step2(){
		allows(array('administrator'));
		if(!$this->session->flashdata('back')){
			if($this->session->userdata('step') && ($this->session->userdata("step") == 1 || $this->session->userdata("step") == 2)){
				//$this->session->set_userdata('step',2);
			}else{
				$this->session->set_flashdata('msg_error','You are continue to add patient test in this step.<br/>If you want to create new patient test, please click on button "Cancel" to restart your task.');
				tests_step_redirect($this->session->userdata('step'));
			}
		}else{
			$this->session->set_userdata('step',2);
		}
		if($_POST){
			$patient = $this->input->post('txt_patId');
			$ill_is_receive = $this->input->post('txt_isReceiveIll');
			$ills = $this->input->post('txt_ills');
			$this->session->set_userdata('txt_patId',$patient);
			$this->session->set_userdata('txt_isReceiveIll',$ill_is_receive);
			$this->session->set_userdata('txt_ills',$ills);
			$str_check = '';
			if ($patient == '0') $str_check .= 'សូម​ជ្រើស​រើស អ្នក​ជំ​ងឺ<br/>';
			if (!$ills) $str_check .= 'សូម​ជ្រើស​រើស ជំ​ងឺ​ដើម្បី​ធ្វើ​តេស្ថ យ៉ាង​ហោច​ណាស់​អោយ​បាន​១មុខ<br/>';
			if($str_check != ''){
				$this->session->set_flashdata('msg_error',substr($str_check,0,-5));
				redirect(site_url('tests/add_step1'));
			}
			if($ill_is_receive == '0') $this->session->set_flashdata('msg_info','បញ្ជាក់៖ ជំងឺ​មិន​ទាន់​ទទួល​ពី អ្នក​ជំងឺ​សំរាប់​ធ្វើ​តេស្ថ');
		}else{
			if(!$this->session->userdata('txt_patId')){
				$this->session->set_flashdata('msg_error','អ្នក​មិន​អាច​បង្កើតតេស្ថ ដោយ​មិន​បាន​បំ​ពេញ​ពត៌មាន​ នៅ​ក្នុង​ដំណាក់​កាល់​ទី​១​ទេ។');
				redirect(site_url('tests/add_step1'));
			}
		}
		$this->data['title'] = 'បង្កើត​តេស្ថថ្មី ដំណាក់​កាល​ទី២';
		$this->data['ills_selected_data'] = $this->m_tests->ill_selected_lists($this->session->userdata('txt_ills'));
        $this->load->view(TEMPLATE,  $this->data);
	}

	public function add_step3(){
		allows(array('administrator'));
		if(!$this->session->flashdata('back')){
			if($this->session->userdata('step') && ($this->session->userdata("step") == 1 || $this->session->userdata("step") == 2 || $this->session->userdata("step") == 3)){
				//$this->session->set_userdata('step',3);
			}else{
				$this->session->set_flashdata('msg_error','You are continue to add patient test in this step.<br/>If you want to create new patient test, please click on button "Cancel" to restart your task.');
				tests_step_redirect($this->session->userdata('step'));
			}
		}else{
			$this->session->set_userdata('step',3);
		}
		if($_POST){
			$datetime_received = $this->input->post('txt_dateTimeReceived');
			$discount = ($this->input->post('txt_discount')=='')?0:$this->input->post('txt_discount');
			$deposit = ($this->input->post('txt_deposit')=='')?0:$this->input->post('txt_deposit');
			$owe = $this->input->post('txt_owe');
			$tax = $this->input->post('txt_tax');
			$pay_all = $this->input->post('txt_payAll');
			$is_paid = ($pay_all == '1')?1:0;
			$subtotal = $this->input->post('txt_subTotal');
			$this->session->set_userdata('txt_dateTimeReceived',$datetime_received);
			$this->session->set_userdata('txt_discount',$discount);
			$this->session->set_userdata('txt_deposit',$deposit);
			$this->session->set_userdata('txt_subTotal',$subtotal);
			$this->session->set_userdata('txt_owe',$owe);
			$this->session->set_userdata('txt_tax',$tax);
			$this->session->set_userdata('txt_payAll',$pay_all);
			$this->session->set_userdata('txt_isPaid',$is_paid);
		}else{
			if(!$this->session->userdata('txt_subTotal')){
				$this->session->set_flashdata('msg_error','អ្នក​មិន​អាច​បង្កើតតេស្ថ ដោយ​មិន​បាន​បំ​ពេញ​ពត៌មាន​ នៅ​ក្នុង​ដំណាក់​កាល់​ទី​២ទេ។');
				redirect(site_url('tests/add_step2'));
			}
		}
		$this->data['title'] = 'បង្កើត​តេស្ថថ្មី ដំណាក់​កាល​បញ្ចប់';
		$this->data['ills_selected_data'] = $this->m_tests->ill_selected_lists($this->session->userdata('txt_ills'));
        $this->load->view(TEMPLATE,  $this->data);
	}
	
	public function add_save(){
		$arr_users_profile = $this->session->userdata(TBL_PREFEX.'users');
		$use_id = $arr_users_profile['use_id'];
		$pat_id = $this->session->userdata('txt_patId');
		$datetime_received = $this->session->userdata('txt_dateTimeReceived');
		$is_received_ill = $this->session->userdata('txt_isReceiveIll');
		$sub_total = $this->session->userdata('txt_subTotal');
		$is_paid = $this->session->userdata('txt_isPaid');
		$deposit = $this->session->userdata('txt_deposit');
		$owe = $this->session->userdata('txt_owe');
		$discount = $this->session->userdata('txt_discount');
		$tax = $this->session->userdata('txt_tax');
		$arr_ill_selected = $this->session->userdata('txt_ills');
		$total = $sub_total - (($sub_total*$discount)/100 + ($sub_total*$tax)/100);
		$doc_id = $this->m_global->get_doctor_by_patient($this->session->userdata('txt_patId'));
		if($doc_id == 0){
			$doctor_commission = 0;
		}else{
			$doctor_commission = ($total*DOCTOR_COMMISSION)/100;
		}
		$total = $total - $doctor_commission;
		//insert data into tbl_patients_tests
		$data_patient_test = array(
			'pat_tes_pat_id' => $pat_id,
			'pat_tes_use_id' => $use_id,
			'pat_tes_dateTimeReceived' => $datetime_received,
			'pat_tes_isReceiveIll' => $is_received_ill,
			'pat_tes_subTotal' => $sub_total,
			'pat_tes_total' => $total,
			'pat_test_isPaid' => $is_paid,
			'pat_tes_deposit' => $deposit,
			'pat_tes_owe' => $owe,
			'pat_tes_discount' => $discount,
			'pat_tes_tax' => $tax,
			'pat_tes_doctorCommission' => $doctor_commission
		);
		$this->m_global->insert(TBL_PREFEX.'patients_tests',$data_patient_test);
		$pat_tes_id = $this->db->insert_id();
		//insert data into tbl_doctors_commissions in case patient has reference from doctor
		if($doc_id != 0){
			$data_doctor_commission = array(
				'doc_com_doc_id' => $doc_id,
				'doc_com_pat_tes_id' => $pat_tes_id,
				'doc_com_ammount' => $doctor_commission
			);
			$this->m_global->insert(TBL_PREFEX.'doctors_commissions', $data_doctor_commission);
		}
		//insert data into tbl_patients_tests_has_tbl_ills for join between patient test and ills
		$arr_fields = array('pat_tes_id','ill_id');
		$arr_data = array();
		foreach ($arr_ill_selected as $key => $value) {
			array_push($arr_data,array($pat_tes_id,$value));
		}
		$this->m_global->insert_multi(TBL_PREFEX.'patients_tests_has_tbl_ills',$arr_fields,$arr_data);
		
		//insert data into tbl_patients_tests_results for input the result
		$query_select_ill = $this->m_global->select_where_in(TBL_PREFEX.'ills_items',array('ill_ite_ill_id' => $arr_ill_selected));
		if($query_select_ill->num_rows() > 0){
			$arr_fields_tests_results = array('pat_tes_res_pat_tes_id', 'pat_tes_res_ill_ite_id');
			$arr_data_tests_results = array();
			foreach ($query_select_ill->result() as $ill_item_rows) {
				array_push($arr_data_tests_results,array($pat_tes_id,$ill_item_rows->ill_ite_id));
				
			}
			$this->m_global->insert_multi(TBL_PREFEX.'patients_tests_results',$arr_fields_tests_results,$arr_data_tests_results);
		}
		$this->session->set_flashdata('msg_success','New patient test has been created.');
	}
	
	public function edit($id=NULL){
		
	}
	
	public function edit_save(){
		
	}
	
	public function lists(){
		if($this->input->post('data'))
            $this->load->view('tests/lists',  $this->data);
        else{
            $this->data['title'] = 'Display all tests';
			$this->data['patients_tests_data'] = $this->m_global->select_all(VIE_PREFEX.'patients_tests');
            $this->load->view(TEMPLATE,  $this->data);
        }
	}
	
	public function add_patient(){
		$this->session->set_userdata('new_patient_exam_test',site_url('tests/add'));
		redirect(site_url('patients/add'));
	}
	
	public function add_cancel(){
		$arr_unset_session = array();
		if($this->session->userdata('txt_patId')) $arr_unset_session['txt_patId'] = '';
		if($this->session->userdata('txt_isReceiveIll')) $arr_unset_session['txt_isReceiveIll'] = '';
		if($this->session->userdata('txt_ills')) $arr_unset_session['txt_ills'] = '';
		if($this->session->userdata('txt_dateTimeReceived')) $arr_unset_session['txt_dateTimeReceived'] = '';
		if($this->session->userdata('txt_discount')) $arr_unset_session['txt_discount']='';
		if($this->session->userdata('txt_deposit')) $arr_unset_session['txt_discount']='txt_deposit';
		if($this->session->userdata('txt_subTotal')) $arr_unset_session['txt_subTotal'] = '';
		if($this->session->userdata('txt_owe')) $arr_unset_session['txt_owe'] = '';
		if($this->session->userdata('txt_tax')) $arr_unset_session['txt_tax'] = '';
		if($this->session->userdata('txt_payAll')) $arr_unset_session['txt_payAll'] = '';
		if($this->session->userdata('txt_isPaid')) $arr_unset_session['txt_isPaid'] = '';

		if($this->session->unset_userdata($arr_unset_session) == NULL){
			$this->session->set_flashdata('msg_info','អ្នក​បាន​បោះបង់ ​ការ​បង្កើត តេស្ថ');
		}else{
			$this->session->set_flashdata('msg_error','មិន​អាច​បោះ​បង់ ការ​បង្កើតតេស្ថ។ សូម​ព្យា​យាម​ម្តង​ទៀត។');
		}
		redirect(site_url('tests/lists'));
	}
	/*
	function select_ill_order_by_group(){
		$arr_data = array();
		$this->db->where('ill_gro_status',1);
		$ill_group_data = $this->db->get(TBL_PREFEX.'ills_groups');
		if($ill_group_data->num_rows() > 0){
			foreach($ill_group_data->result() as $groups){
				$arr_ill = array();
				$this->db->where('ill_ill_gro_id',$groups->ill_gro_id);
				$ill_data = $this->db->get(TBL_PREFEX.'ills');
				if($ill_data->num_rows() > 0){
					foreach($ill_data->result() as $ills){
						$arr_ill[$ills->ill_id] = $ills->ill_name;
					} 
				}
				$arr_data[$groups->ill_gro_name] = $ill_data;
			}
		}
		return $arr_data;
	}
	 * 
	 */
}