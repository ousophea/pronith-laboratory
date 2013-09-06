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
            return $this->get_dropdown_data($data);
        }
        
    }
    
    function get_dropdown_data($result_set){
        $data[''] = DROPDOWN_DEFAULT;
        foreach ($result_set->result_array() as $value) {
            $data[$value[GRO_ID]] = $value[GRO_NAME];
        }
        return $data;
    }
}

?>
