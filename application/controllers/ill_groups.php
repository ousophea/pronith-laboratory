<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ill_groups
 *
 * @author sochy.choeun
 */
class ill_groups extends CI_Controller{
    //put your code here
    var $data = null;
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_ill_groups'));
    }
    
    function add(){
        $this->data['title'] = 'Create new ill groups';
        $this->load->view('ill_groups/add',  $this->data);
    }
    
    function create(){
        //var_dump($this->m_ill_groups->create());die();
        echo json_encode(array('result' => $this->m_ill_groups->create()));
    }
    
    function delete(){
        echo json_encode(array('result' => $this->m_ill_groups->delete()));
    }
    function lists(){
        $this->data['title'] = 'List ill groups';
        $this->data['data'] = $this->m_ill_groups->getIllGroups();
        $this->load->view('ill_groups/lists',  $this->data);
    }
    
    function edit(){
        
        $this->data['title'] = 'Edit ill group';
        $this->data['data'] = $this->input->post('data');
        $this->load->view('ill_groups/edit',  $this->data);
    }
    
    function update(){
        //echo $this->m_users->update();
        echo json_encode(array('result' => $this->m_ill_groups->update()));
    }
    /**
     * Change status
     */
    function status(){
        echo json_encode(array('result' => $this->m_ill_groups->status()));
    }
}

?>
