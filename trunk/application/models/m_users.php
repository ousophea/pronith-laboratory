<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_users
 *
 * @author sochy.choeun
 */
class m_users extends CI_Model {

    /**
     * 
     * @return int
     */
    function login() {
        try {
            $this->db->where(USE_USERNAME, $this->input->post(USE_USERNAME));
            $this->db->where(USE_PASSWORD, sha1(PASSWORD_PREFEX . $this->input->post(USE_PASSWORD)));
            $this->db->join(GROUPS, GRO_ID . '=' . USE_GROUPID);
            $data = $this->db->get(USERS);
            if ($data->num_rows() > 0) {
                // create array result
                $data->result_array();
                // create session array
                $result_array = $data->result_array[0];
                unset($result_array[USE_PASSWORD]);
                // create array session
                $this->session->set_userdata(USERS, $result_array );
                
                $groups = $this->db->get(GROUPS);
                $groups->result_array();
                $this->session->set_userdata(GROUPS,$groups->result_array);
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $exc) {
            return 2;
        }
    }

    /**
     * 
     * @return int 
     */
    function register() {
        try {
            $this->db->where(USE_USERNAME, $this->input->post(USE_USERNAME));
            $data = $this->db->get(USERS);
            if ($data->num_rows() > 0) {
                return 0;
            } else {
                $this->db->set(USE_USERNAME, $this->input->post(USE_USERNAME));
                $this->db->set(USE_PASSWORD, sha1(PASSWORD_PREFEX . $this->input->post(USE_PASSWORD)));
                $this->db->set(USE_GROUPID, 1);
                $this->db->insert(USERS);
                return 1;
            }
        } catch (Exception $exc) {
            return 2;
        }
    }

    function getUsers() {
        try {
            $this->db->join(GROUPS, GRO_ID . '=' . USE_GROUPID);
            return $this->db->get(USERS);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function delete() {
        try {
            $this->db->where(USE_ID, $this->uri->segment(3));
            if ($this->db->delete(USERS))
                return 1;
            else
                return 0;
        } catch (Exception $exc) {
            return 2;
        }
    }
    function update() {
        try {
            $data = $this->input->post('data');
            if(empty($data[USE_STATUS])) $data[USE_STATUS] = 0;
            else $data[USE_STATUS] = 1;
            $this->db->where(USE_ID, $data[USE_ID]);
            unset($data[USE_ID]);
            if ($this->db->update(USERS,  $data))
                return 1;
            else
                return 0;
        } catch (Exception $exc) {
            return 2;
        }
    }

}

?>
