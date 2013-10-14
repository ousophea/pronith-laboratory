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
			$owe = ($this->input->post('txt_owe') == '')?0:$this->input->post('txt_owe');
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
			//get time to compare with date_time_receive ill
			$date = new DateTime();
			$timestamp_now = $date->getTimestamp();
			
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
			$arr_doctor_row = $this->m_global->select_where_limit_one(TBL_PREFEX.'doctors',array('doc_id'=>$doc_id,'doc_status'=>1));
			if(count($arr_doctor_row) > 0){
				$doctor_commission = ($total*$arr_doctor_row[0]['doc_commission'])/100;
			}else{
				$doctor_commission = 0;
			}
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
			'pat_tes_isPaid' => $is_paid,
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
			$arr_doctor_row = $this->m_global->select_where_limit_one(TBL_PREFEX.'doctors',array('doc_id'=>$doc_id,'doc_status'=>1));
			if(count($arr_doctor_row) > 0){
				$data_doctor_commission = array(
					'doc_com_doc_id' => $doc_id,
					'doc_com_pat_tes_id' => $pat_tes_id,
					'doc_com_ammount' => $doctor_commission
				);
				$this->m_global->insert(TBL_PREFEX.'doctors_commissions', $data_doctor_commission);
			}
		}
		//insert data into tbl_patients_tests_has_tbl_ills for join between patient test and ills
		$arr_fields = array('pat_tes_id','ill_id');
		$arr_data = array();
		foreach ($arr_ill_selected as $key => $value) {
			array_push($arr_data,array($pat_tes_id,$value));
		}
		$this->m_global->insert_multi(TBL_PREFEX.'patients_tests_has_tbl_ills',$arr_fields,$arr_data);
		
		//insert data into tbl_patients_tests_results for input the result
		/*
		$query_select_ill = $this->m_global->select_where_in(TBL_PREFEX.'ills_items',array('ill_ite_ill_id' => $arr_ill_selected));
		if($query_select_ill->num_rows() > 0){
			$arr_fields_tests_results = array('pat_tes_res_pat_tes_id', 'pat_tes_res_ill_ite_id');
			$arr_data_tests_results = array();
			foreach ($query_select_ill->result() as $ill_item_rows) {
				array_push($arr_data_tests_results,array($pat_tes_id,$ill_item_rows->ill_ite_id));
			}
			$this->m_global->insert_multi(TBL_PREFEX.'patients_tests_results',$arr_fields_tests_results,$arr_data_tests_results);
		}
		 */
		$this->session->set_userdata('txt_testId',$pat_tes_id);
		$this->session->set_flashdata('msg_success','តេស្ថ​ថ្មី​ ត្រូវ​បាន​បង្កើត​ដោយ​ជោគ​ជ័យៃ។​ សូម​ព្រីន​វិក័យ​ប័ត្រ​ មុន​នឹង​បិទ​ផ្ទាំង​​កិច្ច​ការ');
		$this->data['title'] = 'បង្កើត​តេស្ថថ្មី​ជោគ​ជ័យ ចេញ​វិក័យប័ត្រ';
		$this->data['ills_selected_data'] = $this->m_tests->ill_selected_lists($this->session->userdata('txt_ills'));
        $this->load->view(TEMPLATE,  $this->data);
	}
	
	public function input_result_tests($id = ''){
		$check = $this->m_global->check_data_exist(TBL_PREFEX.'patients_tests_results',array('pat_tes_res_pat_tes_id'=>$id));
		$pat_id = $this->m_global->get_one_value(TBL_PREFEX.'patients_tests','pat_tes_pat_id',array('pat_tes_id'=>$id));
		if($check){
			$this->session->set_flashdata('msg_error','សូម​អភ័យ​ទោស លទ្ធផល​ដែល​អ្នក​កំ​ពុង​ព្យាយាម​បញ្ចូល ត្រូវ​បាន​បញ្ចូល​រួច​ពី​មុន​ហើយ');
			redirect('tests/lists');
		}elseif($id != '' && is_numeric($id) && $pat_id){
			if($pat_id){
				$this->data['pat_sex'] = ($this->m_global->get_one_value(TBL_PREFEX.'patients','pat_sex',array('pat_id'=>$pat_id)))?$this->m_global->get_one_value(TBL_PREFEX.'patients','pat_sex',array('pat_id'=>$pat_id)):'N/A';
			}else{
				$this->data['pat_sex'] = 'N/A';
			}
			$this->data['title'] = 'បញ្ចូល​លទ្ធផល តេស្ថ​អ្នក​ជំងឺ';
			$this->data['pat_tes_id'] = $id;
			$this->data['items_tests_data'] = $this->m_global->select_where(VIE_PREFEX.'patients_tests_results_inputs',array('pat_tes_id'=>$id));
			$this->data['patients_tests_data'] = $this->m_global->select_where(TBL_PREFEX.'patients_tests',array('pat_tes_id'=>$id));
        	$this->load->view(TEMPLATE,  $this->data);
		}else{
			$this->session->set_flashdata('msg_error','តេស្ថ​អ្នក​ជំ​ងឺ ដែល​អ្នក​កំ​ពុង​ចង់​ បញ្ចូល​លទ្ធផល ពុំ​មាន​នៅ​ក្នុង​ប្រព័ន្ធ​ទេ');
			redirect(site_url('tests/lists'));
		}
	}

	public function input_result_tests_save(){
		if($_POST){
			$patient_test_id = $this->input->post('txt_patTesId');
			$arr_ills_items = $this->input->post('txt_illItemId');
			$arr_ills_items_values = $this->input->post('txt_illItemResult');
			var_dump($patient_test_id);
			var_dump($arr_ills_items);
			var_dump($arr_ills_items_values);
			$arr_fiels = array('pat_tes_res_pat_tes_id','pat_tes_res_ill_ite_id','pat_tes_res_value');
			$arr_data = array();
			for($i = 0; $i < count($arr_ills_items); $i++){
				array_push($arr_data,array($patient_test_id,$arr_ills_items[$i],$arr_ills_items_values[$i]));
			}
			if($this->m_global->insert_multi(TBL_PREFEX.'patients_tests_results',$arr_fiels,$arr_data)){
				$this->m_global->update(TBL_PREFEX.'patients_tests',array('pat_tes_isResult'=>1),array('pat_tes_id'=>$patient_test_id));
				$this->session->set_flashdata('msg_success','លទ្ធផល​តេស្ថ ត្រូវ​បាន​បញ្ចូល​ ដោយ​ជោគ​ជ័យ');
			}else{
				$this->session->set_flashdata('msg_success','បរា​ជ័យ ក្នុង​ការ​បញ្ចូលលទ្ធផល​តេស្ថ។ សូម​ព្យាយាម​ម្តង​ទៀត');
			}
		}else{
			$this->session->set_flashdata('msg_error','អ្នក​មិន​អាច ចូល​មក​កាន់​ទី​នេះ​ ដោយ​មធ្យោបាយ​បែប​នេះ​បាន​ទេ');
		}
		redirect('tests/lists');
	}

	public function print_result_tests($id=''){
		$check = $this->m_global->check_data_exist(VIE_PREFEX.'patients_tests_results_views',array('pat_tes_res_pat_tes_id'=>$id));
		if($id!='' && is_numeric($id) && $check){
			$this->data['title'] = 'ព្រីន​លទ្ធផល​តេស្ថ​ជំងឺ';
			$this->data['patients_tests_data'] = $this->m_global->select_join(TBL_PREFEX.'patients_tests',array(TBL_PREFEX.'patients'=>array('pat_tes_pat_id'=>'pat_id')),'inner',array(TBL_PREFEX.'patients_tests.pat_tes_id'=>$id));
			$this->data['patients_tests_results_data'] = $this->m_global->select_where(VIE_PREFEX.'patients_tests_results_views',array('pat_tes_res_pat_tes_id'=>$id));
			$this->load->view(TEMPLATE,  $this->data);
		}else{
			$this->session->set_flashdata('msg_error','សូម​អភ័យ​ទោស តេស្ថ​ជំងឺ​ដែល​អ្នក​កំពុង​ព្យាយាមព្រីន មិន​មាន​នៅ​ក្នុង​ប្រព័ន្ធ ឬ​មិន​ទាន់​ត្រូវ​បាន​បញ្ចូល​លទ្ធផល។ សូម​​បញ្ចូល​​លទ្ធផល ហើយ​ព្យាយាម​ម្តង​ទៀត');
			redirect('tests/lists');
		}
	}
	
	public function pay_tests($id = ''){
		$check = $this->m_global->check_data_exist(TBL_PREFEX.'patients_tests',array('pat_tes_id'=>$id,'pat_tes_isPaid'=>1));
		if($id!='' && is_numeric($id) && !$check){
			$this->data['title'] = 'កែប្រែ វិក័យប័ត្របង់​ប្រាក់';
			$this->data['patients_tests_data'] = $this->m_global->select_join(TBL_PREFEX.'patients_tests',array(TBL_PREFEX.'patients'=>array('pat_tes_pat_id'=>'pat_id')),'inner',array(TBL_PREFEX.'patients_tests.pat_tes_id'=>$id));
			$this->load->view(TEMPLATE,  $this->data);
		}else{
			$this->session->set_flashdata('msg_error','សូម​អភ័យ​ទោស តេស្ថ​ជំងឺ​ដែល​អ្នក​កំពុង​ព្យាយាម​បង់​ប្រាក់ មិន​មាន​នៅ​ក្នុង​ប្រព័ន្ធ ឬ​វិក័យ​ប័ត្រ ត្រូវ​បាន​បង់​ប្រាក់​រួច​ហើយ។ សូម​​ធ្វើ​ការ​ត្រួត​ពិនិត្យ​ឡើង​វិញ ហើយ​ព្យាយាម​ម្តង​ទៀត');
			//redirect('tests/lists');
		}
	}
	
	public function pay_tests_save(){
		if($_POST){
			$patient_test_id = $this->input->post('txt_patTesId');
			$patient_pay = $this->input->post('txt_patTesPay');
			$subtotal = $this->m_global->get_one_value(TBL_PREFEX.'patients_tests','pat_tes_subTotal',array('pat_tes_id'=>$patient_test_id));
			$discount = $this->m_global->get_one_value(TBL_PREFEX.'patients_tests','pat_tes_discount',array('pat_tes_id'=>$patient_test_id));
			$deposit = $this->m_global->get_one_value(TBL_PREFEX.'patients_tests','pat_tes_deposit',array('pat_tes_id'=>$patient_test_id));
			echo $subtotal.'-'.$discount.'-'.$deposit.'-'.$patient_pay.'<br/>';
			echo $deposit+$patient_pay;
			echo '<br/>';
			echo ($subtotal-($subtotal*$discount)/100);
			if(($deposit+$patient_pay) == ($subtotal-($subtotal*$discount)/100)){
				echo 'True';
			}else{
				echo 'False';
			}
			echo '<br/>*'.($subtotal-($subtotal*$discount)/100)-$deposit;
		}else{
			$this->session->set_flashdata('msg_error','អ្នក​មិន​អាច ចូល​មក​កាន់​ទី​នេះ​ ដោយ​មធ្យោបាយ​បែប​នេះ​បាន​ទេ');
		}
	}
	
	public function edit($id=NULL){
		
	}
	
	public function edit_save(){
		
	}
	
	public function lists(){
		if($this->input->post('data'))
            $this->load->view('tests/lists',  $this->data);
        else{
            $this->data['title'] = 'បង្ហាញ​រាល់​ តេស្ថ​អ្នក​ជំងឺ';
			$this->data['patients_tests_data'] = $this->m_global->select_all(VIE_PREFEX.'patients_tests');
            $this->load->view(TEMPLATE,  $this->data);
        }
		$this->remove_session_test();
	}
	
	public function add_patient(){
		$this->session->set_userdata('new_patient_exam_test',site_url('tests/add'));
		redirect(site_url('patients/add'));
	}
	
	public function add_cancel(){
		if($this->remove_session_test() == NULL){
			$this->session->set_flashdata('msg_info','អ្នក​បាន​បោះបង់ ​ការ​បង្កើត តេស្ថ');
		}else{
			$this->session->set_flashdata('msg_error','មិន​អាច​បោះ​បង់ ការ​បង្កើតតេស្ថ។ សូម​ព្យា​យាម​ម្តង​ទៀត។');
		}
		redirect(site_url('tests/lists'));
	}

	private function remove_session_test(){
		$arr_unset_session = array();
		if($this->session->userdata('txt_patId')) $arr_unset_session['txt_patId'] = '';
		if($this->session->userdata('txt_isReceiveIll')) $arr_unset_session['txt_isReceiveIll'] = '';
		if($this->session->userdata('txt_ills')) $arr_unset_session['txt_ills'] = '';
		if($this->session->userdata('txt_dateTimeReceived')) $arr_unset_session['txt_dateTimeReceived'] = '';
		if($this->session->userdata('txt_discount')) $arr_unset_session['txt_discount']='';
		if($this->session->userdata('txt_deposit')) $arr_unset_session['txt_deposit']='';
		if($this->session->userdata('txt_subTotal')) $arr_unset_session['txt_subTotal'] = '';
		if($this->session->userdata('txt_owe')) $arr_unset_session['txt_owe'] = '';
		if($this->session->userdata('txt_tax')) $arr_unset_session['txt_tax'] = '';
		if($this->session->userdata('txt_payAll')) $arr_unset_session['txt_payAll'] = '';
		if($this->session->userdata('txt_isPaid')) $arr_unset_session['txt_isPaid'] = '';
		return $this->session->unset_userdata($arr_unset_session);
	}
}