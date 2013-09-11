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
class m_ill_items extends CI_Model{
    //put your code here
    function lists(){
        $this->db->from(ILLITEMS);
        $this->db->join(ILLS,ILI_ILLID.'='.ILL_ID);
        $this->db->join(ILLGROUPS,ILG_ID.'='.ILL_GROUPID);
        $this->db->set(ILI_STATUS,1);
        return $this->db->get();;
        
    }
    
    /**
     * 
     * @return type
     */
    function group_array(){
        $data = $this->db->get(ILLS);
        $this->db->where(ILL_STATUS,1);
        if($data->num_rows() > 0){
            return $this->m_global->get_dropdown_data($data,ILL_ID,ILL_NAME);
        }
        else
            return array();
        
    }
    /**
     * 
     * @return int
     */
    
    function create(){
        
        try {
            $data = $this->input->post('data');
            $this->db->where(ILI_NAME,$data[ILI_NAME]);
            $query = $this->db->get(ILLITEMS);
            if($query->num_rows() > 0) return 3;
            if(empty($data[ILI_STATUS])) $data[ILI_STATUS] = 0;
            else $data[ILI_STATUS] = 1;
            if($this->db->insert(ILLITEMS, $data)){
                return 1;
            }
            else return 0;
        } catch (Exception $exc) {
            return 2;
        }
    }
    
    function delete() {
        try {
            $data = $this->input->post('data');
            $this->db->where(ILI_ID, $data[ILI_ID]);
            if ($this->db->delete(ILLITEMS))
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
            if(empty($data[ILI_STATUS])) $data[ILI_STATUS] = 0;
            else $data[ILI_STATUS] = 1;
            $this->db->set(ILI_DATEMODIFIED,'NOW()',FALSE);
            $this->db->where(ILI_ID, $data[ILI_ID]);
            unset($data[ILI_ID]);
            if ($this->db->update(ILLITEMS,  $data))
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
            if($data[ILI_STATUS]==1) $data[ILI_STATUS] = 0;
            else $data[ILI_STATUS] = 1;
            $this->db->set(ILI_STATUS,$data[ILI_STATUS]);
            $this->db->set(ILI_DATEMODIFIED,'NOW()',FALSE);
            $this->db->where(ILI_ID, $data[ILI_ID]);
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
