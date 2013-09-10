<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ill_items
 *
 * @author sochy.choeun
 */
class ill_items extends CI_Controller {
    //put your code here
    var $data = null;
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_ill_items'));
    }
    
    function lists(){
        $this->data['title'] = 'Ill';
        $this->data['data'] = $this->m_ill_items->lists();
        $this->load->view('ill_items/lists',  $this->data);
    }
    
    
    function add(){
        $this->data['title'] = 'Create new ill';
        $this->data['groups'] = $this->m_ill_items->group_array();
        $this->load->view('ill_items/add',  $this->data);
    }
    
    function create(){
        echo json_encode(array('result' => $this->m_ill_items->create()));
    }
    
    function delete(){
        echo json_encode(array('result' => $this->m_ill_items->delete()));
    }
    
    function edit(){
        
        $this->data['title'] = 'Edit ill group';
        $this->data['groups'] = $this->m_ill_items->group_array();
        $this->data['data'] = $this->input->post('data');
        $this->load->view('ills/edit',  $this->data);
    }
    
    function update(){
        //echo $this->m_users->update();
        echo json_encode(array('result' => $this->m_ill_items->update()));
    }
    /**
     * Change status
     */
    function status(){
        echo json_encode(array('result' => $this->m_ill_items->status()));
    }
}

?>
