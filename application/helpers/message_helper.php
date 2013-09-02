<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


if (!function_exists('message')) {

    function message($type='success',$keyword='Done! ', $message='Defualt message') {
        $obj = & get_instance();
        $obj->load->helper(array('html', 'url'));
        $html ='
        <div class = "alert alert-'.$type.'">
            <button type = "button" class = "close" data-dismiss = "alert">
            <i class = "icon-remove"></i>
        </button>

        <strong>
            <i class = "icon-remove"></i>
            '.$keyword.'
        </strong>
        '.$message.'
        <br>
        </div>';
        return $html;
    }

}
?>
