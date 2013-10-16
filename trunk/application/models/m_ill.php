<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_ill
 *
 * @author sochy.choeun
 */
class m_ill extends CI_Model{
    //put your code here
    function lists(){
        $this->db->join(ILLGROUPS,ILG_ID.'='.ILL_GROUPID);
        $this->db->set(ILL_STATUS,1);
        return $this->db->get(ILLS);
    }
    
    /**
     * 
     * @return type
     */
    function group_array(){
        $this->db->where(ILG_STATUS,1);
        $data = $this->db->get(ILLGROUPS);
        
        if($data->num_rows() > 0){
            return $this->m_global->get_dropdown_data($data,ILG_ID,ILG_NAME);
        }
        
    }
    /**
     * 
     * @return int
     */
    
    function create(){
        
        try {
            $data = $this->input->post('data');
            $this->db->where(ILL_NAME,$data[ILL_NAME]);
            $this->db->where(ILL_GROUPID,$data[ILL_GROUPID]);
            $query = $this->db->get(ILLS);
            if($query->num_rows() > 0) return 3;
            if(empty($data[ILL_STATUS])) $data[ILL_STATUS] = 0;
            else $data[ILL_STATUS] = 1;
            if($this->db->insert(ILLS, $data)){
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
            if(empty($data[ILL_STATUS])) $data[ILL_STATUS] = 0;
            else $data[ILL_STATUS] = 1;
            $this->db->set(ILL_DATEMODIFIED,'NOW()',FALSE);
            $this->db->where(ILL_ID, $data[ILL_ID]);
            unset($data[ILL_ID]);
            if ($this->db->update(ILLS,  $data))
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
            if($data[ILL_STATUS]==1) $data[ILL_STATUS] = 0;
            else $data[ILL_STATUS] = 1;
            $this->db->set(ILL_STATUS,$data[ILL_STATUS]);
            $this->db->set(ILL_DATEMODIFIED,'NOW()',FALSE);
            $this->db->where(ILL_ID, $data[ILL_ID]);
            if ($this->db->update(ILLS))
                return 1;
            else
                return 0;
        } catch (Exception $exc) {
            return 2;
        }
    }
}

?>
