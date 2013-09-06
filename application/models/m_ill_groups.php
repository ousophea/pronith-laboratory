<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_ill_groups
 *
 * @author sochy.choeun
 */
class m_ill_groups extends CI_Model{
    //put your code here
    function getIllGroups(){
        $this->db->set(ILG_STATUS,1);
        return $this->db->get(ILLGROUPS);
    }
    
    function create(){
        
        try {
            $data = $this->input->post('data');
            $this->db->where(ILG_NAME,$data[ILG_NAME]);
            $query = $this->db->get(ILLGROUPS);
            if($query->num_rows() > 0) return 3;
            if(empty($data[STATUS])) $data[STATUS] = 0;
            else $data[STATUS] = 1;
            if($this->db->insert(ILLGROUPS, $data)){
                return 1;
            }
            else return 0;
        } catch (Exception $exc) {
            return 2;
        }
    }
    
    function delete() {
        try {
            $this->db->where(ILG_ID, $this->uri->segment(3));
            if ($this->db->delete(ILLGROUPS))
                return 1;
            else
                return 0;
        } catch (Exception $exc) {
            return 2;
        }
    }
    function update(){
         try {
            $data = $this->input->post('data');
            if(empty($data[STATUS])) $data[STATUS] = 0;
            else $data[STATUS] = 1;
            $this->db->set(ILG_DATEMODIFIED,'NOW()',FALSE);
            $this->db->where(ILG_ID, $data[ILG_ID]);
            unset($data[ILG_ID]);
            if ($this->db->update(ILLGROUPS,  $data))
                return 1;
            else
                return 0;
        } catch (Exception $exc) {
            return 2;
        }
    }
    
    function status(){
        try {
            $data = $this->input->post('data');
            if($data[STATUS]==1) $data[STATUS] = 0;
            else $data[STATUS] = 1;
            $this->db->set(STATUS,$data[STATUS]);
            $this->db->set(ILG_DATEMODIFIED,'NOW()',FALSE);
            $this->db->where(ILG_ID, $data[ILG_ID]);
            if ($this->db->update(ILLGROUPS))
                return 1;
            else
                return 0;
        } catch (Exception $exc) {
            return 2;
        }
    }
}

?>
