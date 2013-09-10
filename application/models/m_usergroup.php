<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_usergroup
 *
 * @author sochy.choeun
 */
class m_usergroup extends CI_Model{
    //put your code here
    
    function group_array(){
        $data = $this->db->get(GROUPS);
        if($data->num_rows() > 0){
            return $this->m_global->get_dropdown_data($data,GRO_ID,GRO_NAME);
        }
        
    }
}

?>
