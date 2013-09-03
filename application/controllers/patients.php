<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of patients
 *
 * @author vannak.pen
 */
class Patients extends CI_Controller{
	var $data = null;
	public function __construct(){
		parent::__construct();
	}
	
	
	public function add_new(){
		allows(array('administrator'));
        if($this->input->post('data'))
            $this->load->view('doctors/add_new',  $this->data);
        else{
            $this->data['title'] = 'Add new patient';
            $this->load->view(TEMPLATE,  $this->data);
        }
	}
	
	/**
	 * page view patients
	 */
	public function lists(){
		allows(array('administrator'));
        if($this->input->post('data'))
            $this->load->view('doctors/add_new',  $this->data);
        else{
            $this->data['title'] = 'Add new patient';
            $this->load->view(TEMPLATE,  $this->data);
        }
	}
}
	