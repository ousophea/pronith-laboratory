<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_ill_items
 *
 * @author sochy.choeun
 */
class m_doctors_comm extends CI_Model {

    //put your code here
    function lists($paid = NULL) {
//        $this->db->from(DOCTORCOMMISSIONS);
//        $this->db->join(PARTIENTSTEST,PARTIENTSTEST_ID.'='.DOCCOMM_PAT_TES_ID);
        $this->db->select(DOCTOR . ".*");
        $this->db->select(DOCTORCOMMISSIONS . ".*");
        $this->db->join(DOCTOR, DOC_ID . '=' . DOCCOMM_DOC_ID);
        $this->db->select_sum(DOCCOMM_AMMOUNT);
        $this->db->group_by(DOCCOMM_DOC_ID);
        if ($paid == NULL) {
            $this->db->where(DOCCOMM_GETPAID, 0);
        } else {
             $this->db->where(DOCCOMM_GETPAID, 1);
        }
        return $this->db->get(DOCTORCOMMISSIONS);
//        $this->db->get(DOCTORCOMMISSIONS);
//       return $this->db->last_query();
    }

    function get_paid($doc_id = NULL) {

        $this->db->join(DOCTOR, DOC_ID . '=' . DOCCOMM_DOC_ID);
        $this->db->join(PARTIENTSTEST, PARTIENTSTEST_ID . '=' . DOCCOMM_PAT_TES_ID);
        $this->db->join(PARTIENT, PARTIENT_ID . '=' . PARTIENTSTEST . "." . PARTIENTSTEST_PAR_ID);
//        $this->db->where(array(DOCCOMM_GETPAID=>0, DOCCOMM_DOC_ID=>$doc_id));
//        $this->db->set(DOCCOMM_STATUS,1);
        $this->db->where(array(DOCCOMM_GETPAID => 0, DOCCOMM_DOC_ID => $doc_id));
        return $this->db->get(DOCTORCOMMISSIONS);
//        $this->db->get(DOCTORCOMMISSIONS);
//       return $this->db->last_query();
    }

    function get_paid_info($doc_id = NULL,$doc_paid=NULL) {
        $this->db->join(DOCTOR, DOC_ID . '=' . DOCCOMM_DOC_ID);
        $this->db->join(PARTIENTSTEST, PARTIENTSTEST_ID . '=' . DOCCOMM_PAT_TES_ID);
        $this->db->join(PARTIENT, PARTIENT_ID . '=' . PARTIENTSTEST . "." . PARTIENTSTEST_PAR_ID);
        $this->db->where(array(DOCCOMM_GETPAID =>$doc_paid,DOCCOMM_DOC_ID => $doc_id));
        return $this->db->get(DOCTORCOMMISSIONS);
//        $this->db->get(DOCTORCOMMISSIONS);
//       return $this->db->last_query();
    }
//
//    /**
//     * 
//     * @return type
//     */
//    function ills_array() {
//        $this->db->where(ILL_STATUS, 1);
//        $data = $this->db->get(ILLS);
//
//        if ($data->num_rows() > 0) {
//            return $this->m_global->get_dropdown_data($data, ILL_ID, ILL_NAME);
//        }
//        else
//            return array();
//    }
//
//    /**
//     * 
//     * @return type
//     */
//    function ill_groups_array() {
//        $this->db->where(ILG_STATUS, 1);
//        $data = $this->db->get(ILLGROUPS);
//
//        if ($data->num_rows() > 0) {
//            return $this->m_global->get_dropdown_data($data, ILG_ID, ILG_NAME);
//        }
//    }
//
//    /**
//     * 
//     * @return int
//     */
//    function create() {
//
//        try {
//            $data = $this->input->post('data');
//            $this->db->where(ILI_NAME, $data[ILI_NAME]);
//            $query = $this->db->get(ILLITEMS);
//            if ($query->num_rows() > 0)
//                return 3;
//            if (empty($data[ILI_STATUS]))
//                $data[ILI_STATUS] = 0;
//            else
//                $data[ILI_STATUS] = 1;
//            unset($data[ILG_ID]);
//            if ($this->db->insert(ILLITEMS, $data)) {
//                return 1;
//            }
//            else
//                return 0;
//        } catch (Exception $exc) {
//            return 2;
//        }
//    }
//
//    function delete() {
//        try {
//            $data = $this->input->post('data');
//            $this->db->where(ILI_ID, $data[ILI_ID]);
//            if ($this->db->delete(ILLITEMS))
//                return 1;
//            else
//                return 0;
//        } catch (Exception $exc) {
//            return 2;
//        }
//    }
//
//    function update() {
//        try {
//            $data = $this->input->post('data');
//            if (empty($data[ILI_STATUS]))
//                $data[ILI_STATUS] = 0;
//            else
//                $data[ILI_STATUS] = 1;
//            $this->db->set(ILI_DATEMODIFIED, 'NOW()', FALSE);
//            $this->db->where(ILI_ID, $data[ILI_ID]);
//            unset($data[ILI_ID]);
//            unset($data[ILG_ID]);
//            if ($this->db->update(ILLITEMS, $data))
//                return 1;
//            else
//                return 0;
//        } catch (Exception $exc) {
//            return 2;
//        }
//    }
//
//    function status() {
//        try {
//            $data = $this->input->post('data');
//            if ($data[ILI_STATUS] == 1)
//                $data[ILI_STATUS] = 0;
//            else
//                $data[ILI_STATUS] = 1;
//            $this->db->set(ILI_STATUS, $data[ILI_STATUS]);
//            $this->db->set(ILI_DATEMODIFIED, 'NOW()', FALSE);
//            $this->db->where(ILI_ID, $data[ILI_ID]);
//            if ($this->db->update(ILLS))
//                return 1;
//            else
//                return 0;
//        } catch (Exception $exc) {
//            return 2;
//        }
//    }
//
//    function get_ills_by_group_id() {
//        $this->db->where(ILL_GROUPID, $this->input->post(ILG_ID));
//        $data = $this->db->get(ILLS);
//        if ($data->num_rows() > 0) {
//            $result = $this->m_global->get_dropdown_data($data, ILL_ID, ILL_NAME);
//            return $result;
//        } else {
//            return array('' => DROPDOWN_DEFAULT);
//        }
//    }
//
}

?>
