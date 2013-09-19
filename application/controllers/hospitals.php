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
				$this->session->set_flashdata('msg_success','New hospital has been created!');
				redirect(site_url('hospitals/lists'));
			}else{
				$this->session->set_flashdata('msg_error','Can not create new hospital! Please check again.');
				redirect(site_url('hospitals/add'));
			}
		}
	}
	
	public function edit($id = NULL){
		if($id != NULL){
			allows(array('administrator'));
			$edit_data = $this->m_global->select_where(TBL_PREFEX.'hospitals',array('hos_id'=>$id),1);
			if(!is_numeric($id) || (count($edit_data->result_array()) == 0)){
				$this->session->set_flashdata('msg_error','The hospital you are trying to edit is not exist in our system!');
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
				$this->session->set_flashdata('msg_success','A hospital at id = '.$hos_id.' has been updated!');
				redirect(site_url('hospitals/lists'));
			}else{
				$this->session->set_flashdata('msg_error','A hospital at id = '.$hos_id.' can not be updated! Please try again.');
				redirect(site_url('hospitals/add'));
			}
		}
	}
	
}
