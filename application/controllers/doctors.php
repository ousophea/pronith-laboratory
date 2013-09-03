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
	}
	
	public function add_new(){
		allows(array('administrator'));
        if($this->input->post('data'))
            $this->load->view('doctors/add_new',  $this->data);
        else{
            $this->data['title'] = 'Add new doctor';
            $this->load->view(TEMPLATE,  $this->data);
        }
	}
	
	public function lists(){
		allows(array('administrator'));
		$this->data['data'] = $this->m_global->select_all(TBL_PREFEX.'doctors');
        if($this->input->post('data'))
            $this->load->view('doctors/add_new',  $this->data);
        else{
            $this->data['title'] = 'Add new doctor';
            $this->load->view(TEMPLATE,  $this->data);
        }
	}
	
}
	