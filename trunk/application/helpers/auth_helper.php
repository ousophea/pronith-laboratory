<?php

/**
 * Helper
 * @author Sochy
 * @path application/helpers/auth_helper.php
 */
if (!function_exists('auth')) {
    /**
     * 
     * @param array $array_role_name list superadmin,admin,teller, accountain
     * @see Value of array must be in list: $array_role_name = array("superadmin","admin","teller", "accountain");
     * @return boolean
     */
    function allows($array_role_name) {
        
        $CI = &get_instance();
        $CI->load->library('session');
        $CI->load->helper('url');
        if(!is_login()){
            redirect('users/login');
        }
        $groupsession = $CI->session->userdata(GROUPS);
        $group = null;
        foreach ($groupsession as $value) {
            $group[strtolower($value[GRO_NAME])] =  strtolower($value[GRO_NAME]);
        }
        
        // check if incorrect group allow
        foreach ($array_role_name as $value) {
            if (empty($group[strtolower($value)])){
                // Invalid user group
                echo '<h2>Find the correct allow group name below:</h2>';
                var_dump ($groupsession);
                return 2;
            }
                
        }
        
        foreach ($array_role_name as $value) {
            if (strtolower($value) == strtolower($group[strtolower($value)]))
                return 1;
        }
        return 0;
    }

    /**
     * 
     * @return boolean
     */
    function is_login() {
        $CI = &get_instance();
        $CI->load->library('session');
        if ($CI->session->userdata(USERS))
            return TRUE;
        return FALSE;
    }

}
?>