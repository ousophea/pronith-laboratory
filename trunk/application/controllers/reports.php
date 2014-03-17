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
        $this->load->model(array('m_reports', 'm_ill'));
        $this->load->helper('tests');
        $this->load->model('m_tests');
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
        $this->data['data'] = $this->m_reports->test();
        $this->load->view(TEMPLATE, $this->data);
    }

    function income() {
        allows(array('administrator'));
        $this->data['title'] = REPORT . 'ប្រាក់​ចំ​ណូល';
        $this->load->view(TEMPLATE, $this->data);
    }

    function expend() {
        allows(array('administrator'));
        $this->data['title'] = REPORT . 'ប្រាក់​ចំ​ណាយ';
        $this->data['data'] = $this->m_global->select_all(VIE_PREFEX . 'expends');
        $this->load->view(TEMPLATE, $this->data);
    }
    
    
    private function remove_session_test() {
        allows(array('administrator'));
        $arr_unset_session = array();
        if ($this->session->userdata('txt_patId'))
            $arr_unset_session['txt_patId'] = '';
        if ($this->session->userdata('txt_isReceiveIll'))
            $arr_unset_session['txt_isReceiveIll'] = '';
        if ($this->session->userdata('txt_ills'))
            $arr_unset_session['txt_ills'] = '';
        if ($this->session->userdata('txt_dateTimeReceived'))
            $arr_unset_session['txt_dateTimeReceived'] = '';
        if ($this->session->userdata('txt_discount'))
            $arr_unset_session['txt_discount'] = '';
        if ($this->session->userdata('txt_deposit'))
            $arr_unset_session['txt_deposit'] = '';
        if ($this->session->userdata('txt_subTotal'))
            $arr_unset_session['txt_subTotal'] = '';
        if ($this->session->userdata('txt_owe'))
            $arr_unset_session['txt_owe'] = '';
        if ($this->session->userdata('txt_tax'))
            $arr_unset_session['txt_tax'] = '';
        if ($this->session->userdata('txt_payAll'))
            $arr_unset_session['txt_payAll'] = '';
        if ($this->session->userdata('txt_isPaid'))
            $arr_unset_session['txt_isPaid'] = '';
        return $this->session->unset_userdata($arr_unset_session);
    }


}
