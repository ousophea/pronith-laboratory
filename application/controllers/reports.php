<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reports
 *
 * @author sochy.choeun
 */
class reports extends CI_Controller {

    //put your code here
    var $data = null;

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_reports','m_ill'));
    }

    function index() {
    	allows(array('administrator'));
        $this->data['title'] = REPORT;
        $this->load->view(TEMPLATE, $this->data);
    }

    function patient() {
        $this->data['title'] = REPORT . 'អ្នកជម្ងឺ';
        allows(array('administrator'));
        $this->data['data'] = $this->m_reports->findPatients();
        $this->data['doctors'] = $this->m_reports->findDoctors();
        $this->data['ills'] = $this->m_ill->findIllsByStatus();
        $this->load->view(TEMPLATE, $this->data);
    }

    function doctor() {
    	allows(array('administrator'));
        $this->data['title'] = REPORT . 'វេជ្ជ​បណ្ឌិត';
        allows(array('administrator'));
        $this->data['data'] = $this->m_reports->findDoctors();
        $this->load->view(TEMPLATE, $this->data);
    }

    function test() {
    	allows(array('administrator'));
        $this->data['title'] = REPORT . 'តេស្ថ';
        $this->load->view(TEMPLATE, $this->data);
    }

    function income() {
    	allows(array('administrator'));
        $this->data['title'] = REPORT . 'ប្រាក់​ចំ​ណូល';
        $this->load->view(TEMPLATE, $this->data);
    }
	
	function expend(){
		allows(array('administrator'));
		$this->data['title'] = REPORT . 'ប្រាក់​ចំ​ណាយ';
		$this->data['data'] = $this->m_global->select_all(VIE_PREFEX.'expends');
        $this->load->view(TEMPLATE,  $this->data);
	}

}