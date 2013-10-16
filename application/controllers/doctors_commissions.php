<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ill_items
 *
 * @author sochy.choeun
 */
class doctors_commissions extends CI_Controller {

    //put your code here
    var $data = null;

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_doctors_comm','m_global'));
    }

    function lists() {
        $this->data['title'] = 'DOCTORS COMMISSIONS';
        $this->data['data'] = $this->m_doctors_comm->lists();
//        $this->load->view('doctors_commissions/lists', $this->data);
         $this->load->view(TEMPLATE, $this->data);
//      echo $this->m_doctors_comm->lists();
    }
    
    function invioce() {

        $this->data['doc_com_data'] = $this->m_doctors_comm->get_paid(segment(3));
        $doc_info = $this->data['doc_com_data'];
        if ($doc_info->num_rows() > 0) {
            foreach ($doc_info->result_array() as $row) {
                $doc_name = $row[DOC_FNAME]." ". $row[DOC_LNAME];
                $doc_sex = $row[DOC_SEX];
                $this->session->set_flashdata('doc_id',$row[DOC_ID]);
                break;
            }
        }
        $this->data['doc_name']=$doc_name;
        $this->data['doc_sex']=$doc_sex;
        $this->load->view(TEMPLATE, $this->data);
//        $this->load->view('doctors_commissions/invicoe',  $this->data);
//        echo $this->m_doctors_comm->get_paid(segment(3));
    }
    
    function  get_pat_test_info(){
        
        $data = $this->input->post('data');
        
        $this->data['doc_com_data'] = $this->m_doctors_comm->get_paid_info($data[DOC_ID]);
//        $this->data['doc_com_data'] = $this->m_doctors_comm->get_paid(6);
        $doc_info = $this->data['doc_com_data'];
        
        if ($doc_info->num_rows() > 0) {
            foreach ($doc_info->result_array() as $row) {
                $doc_name = $row[DOC_FNAME]." ". $row[DOC_LNAME];
                $doc_sex = $row[DOC_SEX];
                break;
            }
        }
        $this->data['doc_name']=$doc_name;
        $this->data['doc_sex']=$doc_sex;
//        $this->load->view(TEMPLATE, $this->data);
        $this->load->view('doctors_commissions/doc_com_tes_info',  $this->data);
        
//        echo json_encode(array('result' => $this->data['doc_com_data']));
    }

    function update() {
//        if ($_POST) {
        $doc_id = $this->session->flashdata('doc_id');
        $this->m_global->update('tbl_doctors_commissions',array('doc_com_getPaid'=>1),array('doc_com_doc_id'=>$doc_id));
        $this -> session -> set_flashdata('msg_success', 'បញ្ជី​កំរៃ​ជើងសារជូនវេជ្ជ​បណ្ឌិតត្រូវបានធ្វើ​ការ​ កែប្រែ!');
//        }
        redirect(site_url('doctors_commissions/lists'));
    }

    /**
     * Change status
     */
    function status() {
        echo json_encode(array('result' => $this->m_ill_items->status()));
    }

    function get_ills_by_group_id() {
        echo json_encode(array('result' => $this->m_ill_items->get_ills_by_group_id()));
    }

}

?>
