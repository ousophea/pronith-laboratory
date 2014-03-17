<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_reports
 *
 * @author sochy.choeun
 */
class m_reports extends CI_Model {

    //put your code here

    function findDoctors() {

        if ($this->input->post('date')!='') {
            $date = explode(' to ', $this->input->post('date'));
            $start = $date[0];
            $end = $date[1];
            $this->db->where(DOC_DATECREATED.' >=', $start);
            $this->db->where(DOC_DATECREATED.' <=', $end);
        }
        $this->db->where(DOC_STATUS, 1);
        $this->db->from(DOCTOR);
        $this->db->join(DOCTORPHONE, DOC_ID . '=' . DOCPHONEDOCID);
        $this->db->join(HOSPITALS, DOC_HOSPITALID . '=' . HOSID);
        return $this->db->get();
    }
    function findPatients() {

        $this->db->where('pat_status', 1);
         if ($this->input->post('date')!='') {
            $date = explode(' to ', $this->input->post('date'));
            $start = $date[0];
            $end = $date[1];
            $this->db->where('pat_dateCreated >=', $start);
            $this->db->where('pat_dateCreated <=', $end);
        }
        if ($this->input->post('pat_doc_id')!='' ) {
            $this->db->where('pat_doc_id', $this->input->post('pat_doc_id'));
        }
        if ($this->input->post(ILL_ID)!='' ) {
            $this->db->where(ILLS.'.'.ILL_ID, $this->input->post(ILL_ID));
            $this->db->join('tbl_patients_tests','pat_id=pat_tes_pat_id');
            $this->db->join('tbl_patients_tests_has_tbl_ills','tbl_patients_tests.pat_tes_id=tbl_patients_tests_has_tbl_ills.pat_tes_id');
            $this->db->join(ILLS,ILLS.'.'.ILL_ID.'=tbl_patients_tests_has_tbl_ills.ill_id');
        }
        
        
        $this->db->from('tbl_patients');
        
        $this->db->join('tbl_patients_phones','pat_id=pat_pho_pat_id','left');
        $this->db->join(DOCTOR,'pat_doc_id=doc_id','left');
        return $this->db->get();
    }
    
    function test(){
        if ($this->input->post('date') && $this->input->post('date')!='') {
            $date = explode(' to ', $this->input->post('date'));
            $start = $date[0];
            $end = $date[1];
            $this->db->where('pat_tes_dateCreated >=', $start);
            $this->db->where('pat_tes_dateCreated <=', $end);
        }
        return $this->db->get('vie_patients_tests');
    }
}

?>
