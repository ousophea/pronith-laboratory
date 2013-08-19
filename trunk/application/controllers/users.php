<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author sochy.choeun
 */
class users extends CI_Controller{
    //put your code here
    var $data = null;
    function __construct() {
        parent::__construct();
    }
    
    function index(){
        
        redirect('users/profile');
    }
    
    function login(){
        $this->data['title'] = 'Login | Register';
         $this->load->view('templates/login',  $this->data);
    }
    
    function register(){
        echo json_encode(array('email' => $this->input->post('email')));
    }
    
    function profile(){
        
        $this->data['title'] = 'Welcome';
        
        $this->load->view(TEMPLATE,  $this->data);
    }
    
    function table(){
        $this->load->view(TEMPLATE,  $this->data);
    }
    function calendar(){
        $this->load->view(TEMPLATE,  $this->data);
    }
}

?>
