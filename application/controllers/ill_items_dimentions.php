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
class Ill_items_dimentions extends CI_Controller {
	var $data = null;
	public function __construct() {
		parent::__construct();
		//$this->load->helper('tests');
		//$this->load->model('m_tests');
	}
	
	public function index(){
		allows(array('administrator'));
		redirect(site_url('ill_items_dimentions/lists'));
	}
	
	public function add(){
		$this->data['title'] = 'បង្កើត​ខ្នាត​ សំ​រាប់​ធាតុ​ជំ​ងឺ';
        $this->load->view(TEMPLATE,  $this->data);
	}
	
	public function add_save(){
		if($_POST){
			$dimention_value = $this->input->post('txt_illItemDimentionValue');
			$this->m_global->insert(TBL_PREFEX.'ills_items_dimentions',array('ill_ite_dim_value'=>substr($dimention_value, 0,-4)));
			$this->session->set_flashdata('msg_success','ខ្នាត​នៃ​ធាតុ​ជំងឺ​ ត្រូវ​បាន​បង្កើត​ថ្មី');
		}else{
			$this->session->set_flashdata('msg_error','អ្នក​មិន​អាច​ចូល​មក​កាន់​ទី​នេះ ដោយ​បែប​នេះ​បាន​ទេ');
		}
		redirect(site_url('ill_items_dimentions/lists'));
	}
	
	public function lists(){
		allows(array('administrator'));
		$this->data['title'] = 'បង្ហាញ​រាល់​ ខ្នាត​នៃ​ធាតុ​ជំងឺ';
		$this->data['ills_items_dimentions_data'] = $this->m_global->select_all(TBL_PREFEX.'ills_items_dimentions');
        $this->load->view(TEMPLATE,  $this->data);
	}
	
	public function edit($id=''){
		if($id != '' && is_numeric($id)){
			allows(array('administrator'));
			$edit_data = $this->m_global->select_where(TBL_PREFEX.'ills_items_dimentions',array('ill_ite_dim_id'=>$id),1);
			if((count($edit_data->result_array()) == 0)){
				$this->session->set_flashdata('msg_error','ឈ្មោះ​វេជ្ជ​បណ្ឌិត ដែល​អ្នក​កំ​ពុង​កែប្រែ ពុំ​មាន​នៅ​ក្នុង​ប្រព័ន្ធ​ទេ!');
				redirect(site_url('doctors/lists'));
			}
	        $this->data['title'] = 'កែប្រែ​ខ្នាត';
			$this->data['edit_data'] = $edit_data;
	        $this->load->view(TEMPLATE,  $this->data);
		}else{
			$this->session->set_flashdata('msg_error','ធាតុ​ដែល​អ្នក​កំ​ពុង​កែ​ប្រែ មិន​ត្រូវ​បាន​រក​ឃើញ​នោះ​ទេ សូម​ព្យាយាម​ម្តង​ទៀត');
			redirect(site_url('ill_items_dimentions/lists'));
		}
	}
	public function edit_save(){
		if($_POST){
			$ill_ite_dim_id = $this->input->post('ill_ite_dim_id');
			$ill_ite_dim_value = $this->input->post('txt_illItemDimentionValue');
			if($this->m_global->update(TBL_PREFEX.'ills_items_dimentions',array('ill_ite_dim_value'=>$ill_ite_dim_value),array('ill_ite_dim_id'=>$ill_ite_dim_id))){
				$this->session->set_flashdata('msg_success','ខ្នាត​នៃ​ធាតុ​ជំ​ងឺ​ ត្រូវ​បាន​កែ​ប្រែ​ដោយ​ជោគ​ជ័យ');
			}
			
		}else{
			$this->session->set_flashdata('msg_error','ធាតុ​ដែល​អ្នក​កំ​ពុង​កែ​ប្រែ មិន​ត្រូវ​បាន​រក​ឃើញ​នោះ​ទេ សូម​ព្យាយាម​ម្តង​ទៀត');
		}
		redirect(site_url('ill_items_dimentions/lists'));
	}
	
	public function delete($id=''){
		if($id != '' || is_numeric($id)){
			if($this->m_global->delete(TBL_PREFEX.'ills_items_dimentions',array('ill_ite_dim_id'=>$id))){
				$this->session->set_flashdata('msg_success','ខ្នាត​ធាតុ​នៃ​ជំងឺ ត្រូវ​បាន​លុប​ដោយ​ជោគ​ជ័យ');
			}
		}else{
			$this->session->set_flashdata('msg_error','ធាតុ​ដែល​អ្នក​កំ​ពុង​លុប មិន​ត្រូវ​បាន​រក​ឃើញ​នោះ​ទេ សូម​ព្យាយាម​ម្តង​ទៀត');
		}
		redirect(site_url('ill_items_dimentions/lists'));
	}
}