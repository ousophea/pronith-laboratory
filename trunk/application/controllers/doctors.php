<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of doctors
 *
 * @author vannak.pen
 */
class Doctors extends CI_Controller{
	var $data = null;
	public function __construct(){
		parent::__construct();
		$this->load->helper('doctors');
	}
	
	public function index(){
		redirect(site_url('doctors/lists'));
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
			$doc_first_name = $this->input->post('txt_docFirstName');
			$doc_last_name = $this->input->post('txt_docLastName');
			$doc_sex = $this->input->post('txt_docSex');
			$doc_email = $this->input->post('txt_docEmail');
			$doc_position = $this->input->post('txt_docPosition');
			$doc_hospital = $this->input->post('txt_docHospital');
			$doc_reference = ($this->input->post('txt_docReference')=='0')?NULL:$this->input->post('txt_docReference');
			$doc_status = $this->input->post('txt_docStatus');
			$data_insert = array(
				'doc_firstName'=>$doc_first_name,
				'doc_lastName'=>$doc_last_name,
				'doc_sex'=>$doc_sex,
				'doc_email'=>$doc_email,
				'doc_position'=>$doc_position,
				'doc_hos_id'=>$doc_hospital,
				'doc_reference'=>$doc_reference,
				'doc_status'=>$doc_status);
			if($this->m_global->insert(TBL_PREFEX.'doctors',$data_insert)){
				$last_doctor_id = $this->db->insert_id();
				$arr_doctor_phone = $this->input->post('txt_docPhone');
				$arr_doctor_phone = array_filter($arr_doctor_phone);
				if(count($arr_doctor_phone) > 0){
					$data_batch = array();
					foreach($arr_doctor_phone as $value){
						array_push($data_batch,array($last_doctor_id,$value));
					}
					if($this->m_global->insert_multi(TBL_PREFEX.'doctors_phones',array('doc_pho_doc_id','doc_pho_number'),$data_batch)){
						$this->session->set_flashdata('msg_success','New doctor has been created!');
					}else{
						$this->session->set_flashdata('msg_success','New doctor has been created! But has some error with phone inserted.');
					}
				}else{
					$this->session->set_flashdata('msg_success','New doctor has been created!');
				}
				redirect(site_url('doctors/lists'));
			}else{
				echo '';
			}
		}
	}
	
	public function edit($id=NULL){
		if($id != NULL){
			allows(array('administrator'));
			$edit_data = $this->m_global->select_where(TBL_PREFEX.'doctors',array('doc_id'=>$id),1);
			if(!is_numeric($id) || (count($edit_data->result_array()) == 0)){
				$this->session->set_flashdata('msg_error','The doctor you are trying to edit is not exist in our system!');
				redirect(site_url('doctors/lists'));
			}
	        $this->data['title'] = 'Edit doctor';
			$this->data['edit_data'] = $edit_data;
			$this->data['hospitals_data'] = $this->m_global->select_all(TBL_PREFEX.'hospitals');
			$this->data['doctors_data'] = $this->m_global->select_where_not_in(TBL_PREFEX.'doctors',array('doc_id'=>array($id)));
			$this->data['phones_data'] = $this->m_global->select_where(TBL_PREFEX.'doctors_phones',array('doc_pho_doc_id'=>$id));
	        $this->load->view(TEMPLATE,  $this->data);
		}
	}
	
	public function edit_save(){
		if($_POST){
			$doc_id = $this->input->post('doc_id');
			$doc_first_name = $this->input->post('txt_docFirstName');
			$doc_last_name = $this->input->post('txt_docLastName');
			$doc_sex = $this->input->post('txt_docSex');
			$doc_email = $this->input->post('txt_docEmail');
			$doc_position = $this->input->post('txt_docPosition');
			$doc_hospital = $this->input->post('txt_docHospital');
			$doc_reference = ($this->input->post('txt_docReference')=='0')?NULL:$this->input->post('txt_docReference');
			$doc_status = $this->input->post('txt_docStatus');
			$data_update = array(
				'doc_firstName'=>$doc_first_name,
				'doc_lastName'=>$doc_last_name,
				'doc_sex'=>$doc_sex,
				'doc_email'=>$doc_email,
				'doc_position'=>$doc_position,
				'doc_hos_id'=>$doc_hospital,
				'doc_reference'=>$doc_reference,
				'doc_status'=>$doc_status);
			if($this->m_global->update(TBL_PREFEX.'doctors',$data_update,array('doc_id'=>$doc_id))){
				$arr_doctor_phone = $this->input->post('txt_docPhone');
				$arr_doctor_phone = array_filter($arr_doctor_phone);
				if(count($arr_doctor_phone) > 0){
					$data_batch = array();
					foreach($arr_doctor_phone as $value){
						array_push($data_batch,array($doc_id,$value));
					}
					if($this->m_global->insert_multi(TBL_PREFEX.'doctors_phones',array('doc_pho_doc_id','doc_pho_number'),$data_batch)){
						$this->session->set_flashdata('msg_success','A doctor at id = '.$doc_id.' has been updated!');
					}else{
						$this->session->set_flashdata('msg_success','A doctor at id = '.$doc_id.' has been updated! But has some error with phone number inserted.');
					}
				}else{
					$this->session->set_flashdata('msg_success','A doctor at id = '.$doc_id.' has been updated!');
				}
				redirect(site_url('doctors/lists'));
			}else{
				echo '';
			}
	}
}

	public function lists(){
		allows(array('administrator'));
		$this->data['data'] = $this->m_global->select_all(VIE_PREFEX.'doctors');
        if($this->input->post('data'))
            $this->load->view('doctors/lists',  $this->data);
        else{
            $this->data['title'] = 'List doctors';
            $this->load->view(TEMPLATE,  $this->data);
        }
	}
	
	//page for ajax call to remove the phone number
	public function ajax_remove_phone(){
		if($_POST){
			$id = $this->input->post('id');
			$this->db->delete(TBL_PREFEX.'doctors_phones',array('doc_pho_id'=>$id));
		}
	}
}

