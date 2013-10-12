<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hospital
 *
 * @author vannak.pen
 */
class Hospitals extends CI_Controller{
	function __contruct(){
		parent:__construct();
	}
	
	public function index(){
		redirect(site_url('hospitals/lists'));
	}
	
	public function lists(){
		allows(array('administrator'));
		$this->data['data'] = $this->m_global->select_all(TBL_PREFEX.'hospitals');
        if($this->input->post('data'))
            $this->load->view('hospitals/lists',  $this->data);
        else{
            $this->data['title'] = 'List hospitals';
            $this->load->view(TEMPLATE,  $this->data);
        }
	}
	
	public function add(){
		allows(array('administrator'));
        if($this->input->post('data'))
            $this->load->view('doctors/add',  $this->data);
        else{
            $this->data['title'] = 'Add new doctor';
			$this->data['hospitals_data'] = $this->m_global->select_all(TBL_PREFEX.'hospitals');
			$this->data['doctors_data'] = $this->m_global->select_all(TBL_PREFEX.'doctors');
            $this->load->view(TEMPLATE,  $this->data);
        }
	}
	
	public function add_save(){
		if($_POST){
			$hos_name = $this->input->post('txt_hosName');
			$hos_address = $this->input->post('txt_hosAddress');
			$hos_status = $this->input->post('txt_hosStatus');
			$data_insert = array(
				'hos_name' => $hos_name,
				'hos_address' => $hos_address,
				'hos_status' => $hos_status
			);
			if($this->m_global->insert(TBL_PREFEX.'hospitals',$data_insert)){
				$this->session->set_flashdata('msg_success','មន្ទីរ​ពេទ្យ​ថ្មី ត្រូវ​បាន​បង្កើត!');
				redirect(site_url('hospitals/lists'));
			}else{
				$this->session->set_flashdata('msg_error','មន្ទីរ​ពេទ្យ​ថ្មី មិន​ត្រូវ​បាន​បង្កើត​ទេ! សូម​ព្យាយាម​ម្តង​ទៀត');
				redirect(site_url('hospitals/add'));
			}
		}
	}
	
	public function edit($id = NULL){
		if($id != NULL){
			allows(array('administrator'));
			$edit_data = $this->m_global->select_where(TBL_PREFEX.'hospitals',array('hos_id'=>$id),1);
			if(!is_numeric($id) || (count($edit_data->result_array()) == 0)){
				$this->session->set_flashdata('msg_error','មន្ទីរ​ពេទ្យ ដែល​អ្នក​កំ​ពុង​ ព្យាយាម​កែប្រែ ពុំ​មាន​ក្នុង​ប្រព័ន្ទ​ទេ!');
				redirect(site_url('hospitals/lists'));
			}
	        $this->data['title'] = 'Edit hospital';
			$this->data['edit_data'] = $edit_data;
	        $this->load->view(TEMPLATE,  $this->data);
		}
	}
	
	public function edit_save(){
		if($_POST){
			$hos_id = $this->input->post('hos_id');
			$hos_name = $this->input->post('txt_hosName');
			$hos_address = $this->input->post('txt_hosAddress');
			$hos_status = $this->input->post('txt_hosStatus');
			$data_update = array(
				'hos_name' => $hos_name,
				'hos_address' => $hos_address,
				'hos_status' => $hos_status
			);
			if($this->m_global->update(TBL_PREFEX.'hospitals',$data_update,array('hos_id'=>$hos_id))){
				$this->session->set_flashdata('msg_success','មន្ទីរ​ពេទ្យ​ត្រង់ id = '.$hos_id.' ត្រូវ​បាន​ធ្វើ​ការ​កែប្រែ');
				redirect(site_url('hospitals/lists'));
			}else{
				$this->session->set_flashdata('msg_error','មន្ទីរ​ពេទ្យ​ត្រង់ id = '.$hos_id.' មិន​អាច​ធ្វើ​ការ​កែប្រែ​ បានទេ! សូម​ព្យាយាម​ម្តង​ទៀត');
				redirect(site_url('hospitals/add'));
			}
		}
	}
	
}
