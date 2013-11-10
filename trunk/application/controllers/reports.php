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
        $this->load->model(array('m_reports'));
    }

    function index() {
        $this->data['title'] = REPORT;
        $this->load->view(TEMPLATE, $this->data);
    }

    function partient() {
        $this->load->view(TEMPLATE, $this->data);
    }

    function doctor() {
        $this->data['title'] = REPORT . 'វេជ្ជ​បណ្ឌិត';
        allows(array('administrator'));
        $this->data['data'] = $this->m_reports->findDoctors();
        $this->load->view(TEMPLATE, $this->data);
    }

    function test() {
        $this->data['title'] = REPORT . 'គ្រូពេទ្យ';
        $this->load->view(TEMPLATE, $this->data);
    }

    function income() {
        $this->data['title'] = REPORT . 'គ្រូពេទ្យ';
        $this->load->view(TEMPLATE, $this->data);
    }

}

?>
