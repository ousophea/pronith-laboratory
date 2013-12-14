<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of other expends
 *
 * @author vannak.pen
 */
class Expends extends CI_Controller{
	var $data = null;
	public function __construct(){
		parent::__construct();
		
	}
	
	public function index(){
		redirect(site_url('expends/lists'));
	}
	
	public function add(){
		allows(array('administrator'));
        $this->data['title'] = 'បញ្ចូល​ការ​ចំ​ណាយ​ផ្សេងៗ';
        $this->load->view(TEMPLATE,  $this->data);
	}
	
	public function add_save(){
		allows(array('administrator'));
		if($_POST){
			$expend_title = $this->input->post('txt_expendTitle');
			$expend_description = $this->input->post('txt_expendDescription');
			$expend_amount = $this->input->post('txt_expendAmount');
			$expend_is_paid = $this->input->post('txt_expendIsPaid');
			$expend_status = $this->input->post('txt_expendStatus');
			$data_insert = array(
				'oth_exp_title' => $expend_title,
				'oth_exp_description' => $expend_description,
				'oth_exp_amount' => $expend_amount,
				'oth_exp_isPaid' => $expend_is_paid,
				'oth_exp_status' => $expend_status
			);
			if($this->m_global->insert(TBL_PREFEX.'other_expends',$data_insert)){
				$this->session->set_flashdata('msg_success','ការ​ចំ​ណាយ​ផ្សេងៗ ត្រូវ​បាន​បង្កើត!');
				redirect(site_url('expends/lists'));
			}else{
				$this->session->set_flashdata('msg_error','ការ​ចំ​ណាយ​ផ្សេងៗ មិនត្រូវ​បាន​បង្កើតទេ! សូម​ព្យាយាម​ម្តង​ទៀត');
				redirect(site_url('expends/add'));
			}
		}
	}
	
	public function edit($id = ''){
		allows(array('administrator'));
		if($id != ''){
			if(!is_numeric($id) || ($this->m_global->check_data_exist(TBL_PREFEX.'other_expends',array('oth_exp_id'=>$id)) == FALSE)){
				$this->session->set_flashdata('msg_error','មន្ទីរ​ពេទ្យ ដែល​អ្នក​កំ​ពុង​ ព្យាយាម​កែប្រែ ពុំ​មាន​ក្នុង​ប្រព័ន្ទ​ទេ!');
				redirect(site_url('expends/lists'));
			}
	        $this->data['title'] = 'កែ​ប្រែ​ការ​ចំ​ណាយ​ផ្សេងៗ';
			$this->data['edit_data'] = $this->m_global->select_where(TBL_PREFEX.'other_expends',array('oth_exp_id'=>$id),1);
	        $this->load->view(TEMPLATE,  $this->data);
		}
	}
	
	public function edit_save(){
		allows(array('administrator'));
		if($_POST){
			$expend_id = $this->input->post('txt_expendId');
			$expend_title = $this->input->post('txt_expendTitle');
			$expend_description = $this->input->post('txt_expendDescription');
			$expend_amount = $this->input->post('txt_expendAmount');
			$expend_is_paid = $this->input->post('txt_expendIsPaid');
			$expend_status = $this->input->post('txt_expendStatus');
			$data_update = array(
				'oth_exp_title' => $expend_title,
				'oth_exp_description' => $expend_description,
				'oth_exp_amount' => $expend_amount,
				'oth_exp_isPaid' => $expend_is_paid,
				'oth_exp_status' => $expend_status
			);
			if($this->m_global->update(TBL_PREFEX.'other_expends',$data_update,array('oth_exp_id'=>$expend_id))){
				$this->session->set_flashdata('msg_success','ការ​ចំ​ណា​យ​ផ្សេងៗ​ត្រង់ id = '.$hos_id.' ត្រូវ​បាន​ធ្វើ​ការ​កែប្រែ');
				redirect(site_url('expends/lists'));
			}else{
				$this->session->set_flashdata('msg_error','ការ​ចំ​ណា​យ​ផ្សេងៗ​ត្រង់ id = '.$hos_id.' មិន​អាច​ធ្វើ​ការ​កែប្រែ​ បានទេ! សូម​ព្យាយាម​ម្តង​ទៀត');
				redirect(site_url('expends/add'));
			}
		}
	}
	
	public function lists(){
		allows(array('administrator'));
		$this->data['data'] = $this->m_global->select_all(TBL_PREFEX.'other_expends');
        $this->data['title'] = 'បង្ហាញ​ការ​ចំ​ណាយ​ផ្សេងៗ';
        $this->load->view(TEMPLATE,  $this->data);
	}
	
}