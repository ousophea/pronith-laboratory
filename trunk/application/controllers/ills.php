<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ills
 *
 * @author sochy.choeun
 */
class ills extends CI_Controller{
    //put your code here
    var $data = null;
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_ill'));
    }
    
    function lists(){
        $this->data['title'] = 'Ill';
        $this->data['data'] = $this->m_ill->lists();
//        $this->load->view('ills/lists',  $this->data);
        $this->load->view(TEMPLATE,  $this->data);
    }
    
    
    function add(){
        $this->data['title'] = 'Create new ill';
        $this->data['groups'] = $this->m_ill->group_array();
        $this->load->view('ills/add',  $this->data);
    }
    
    function create(){
        echo json_encode(array('result' => $this->m_ill->create()));
    }
    
    function delete(){
        echo json_encode(array('result' => $this->m_ill->delete()));
    }
    
    function edit(){
        
        $this->data['title'] = 'Edit ill group';
        $this->data['groups'] = $this->m_ill->group_array();
        $this->data['data'] = $this->input->post('data');
        $this->load->view('ills/edit',  $this->data);
    }
    
    function update(){
        //echo $this->m_users->update();
        echo json_encode(array('result' => $this->m_ill->update()));
    }
    /**
     * Change status
     */
    function status(){
        echo json_encode(array('result' => $this->m_ill->status()));
    }
}

?>
