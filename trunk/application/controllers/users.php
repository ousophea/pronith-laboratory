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
        $this->load->model(array('m_users','m_usergroup'));
    }
    
    function index(){
        allows(array('administrator'));
        if($this->input->post('data'))
            $this->load->view('users/profile',  $this->data);
        else{
            $this->data['title'] = 'Welcome';
            $this->load->view(TEMPLATE,  $this->data);
        }
        //redirect('users/profile');
    }
    
    function login(){
        $this->data['title'] = 'Login | Register';
        $this->load->view('templates/login',  $this->data);
    }
    
    function loginrequest(){
        echo json_encode(array('result' => $this->m_users->login()));
    }
    
    function register(){
        echo json_encode(array('result' => $this->m_users->register()));
    }
    
    function add(){
        
        $this->data['title'] = 'Create new user';
        $this->data['groups'] = $this->m_usergroup->group_array();
        $this->load->view('users/add',  $this->data);
    }
    
    function edit(){
        
        $this->data['title'] = 'Edit user';
        $this->data['data'] = $this->input->post('data');
        $this->data['groups'] = $this->m_usergroup->group_array();
        $this->load->view('users/edit',  $this->data);
    }
    
    /**
     * Change status
     */
    function status(){
        echo json_encode(array('result' => $this->m_users->status()));
    }
    
    function update(){
        //echo $this->m_users->update();
        echo json_encode(array('result' => $this->m_users->update()));
    }
    
    function delete(){
        echo json_encode(array('result' => $this->m_users->delete()));
    }
    
    function lists(){
        
        $this->data['title'] = 'List users';
        $this->data['data'] = $this->m_users->getUsers();
        $this->load->view('users/lists',  $this->data);
    }
    
    function loginout(){
        $this->session->sess_destroy();
        redirect('users/login');
    }
    
//    function profile(){
//        allows(array('Admin'));
//        if($this->input->post('data'))
//            $this->load->view('users/profile',  $this->data);
//        else{
//            $this->data['title'] = 'Welcome';
//            $this->load->view(TEMPLATE,  $this->data);
//        }
//        
//    }
    
    function table(){
        $this->load->view(TEMPLATE,  $this->data);
    }
    function calendar(){
        $this->load->view(TEMPLATE,  $this->data);
    }
}

?>
