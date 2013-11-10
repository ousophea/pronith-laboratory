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

        if ($this->input->post('start')) {
            $start = $this->input->post('start');
            $end = $this->input->post('end');
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
        if ($this->input->post('start')!='' && $this->input->post('end')!='' ) {
            $start = $this->input->post('start');
            $end = $this->input->post('end');
            $this->db->where('pat_dateCreated >=', $start);
            $this->db->where('pat_dateCreated <=', $end);
        }
        if ($this->input->post('pat_doc_id')!='' ) {
            $this->db->where('pat_doc_id', $this->input->post('pat_doc_id'));
        }
        
        
        $this->db->from('tbl_patients');
        
        $this->db->join('tbl_patients_phones','pat_id=pat_pho_pat_id','left');
        $this->db->join(DOCTOR,'pat_doc_id=doc_id','left');
        return $this->db->get();
    }

}

?>
