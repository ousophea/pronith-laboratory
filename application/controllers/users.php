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
class users extends CI_Controller {

    //put your code here
    var $data = null;

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_users', 'm_usergroup'));
    }

    function index() {
        allows(array('administrator'));
        if ($this->input->post('data'))
            $this->load->view('users/profile', $this->data);
        else {
            $this->data['title'] = 'សូម​ស្វាគមន៍';
            $this->load->view(TEMPLATE, $this->data);
        }
        //redirect('users/profile');
    }

    function login() {
        $this->data['title'] = 'ចូល​ប្រព័ន្ធ | ចុះ​ឈ្មោះ';
        $this->load->view('templates/login', $this->data);
    }

    function loginrequest() {
        echo json_encode(array('result' => $this->m_users->login()));
    }

    function register() {
        echo json_encode(array('result' => $this->m_users->register()));
    }

    function add() {

        $this->data['title'] = 'បង្កើត​អ្នក​ប្រើប្រាស់​ថ្មី';
        $this->data['groups'] = $this->m_usergroup->group_array();
        $this->load->view('users/add', $this->data);
    }

    function edit() {

        $this->data['title'] = 'កែ​ប្រែ​អ្នក​ប្រើ​ប្រាស់';
        $this->data['data'] = $this->input->post('data');
        $this->data['groups'] = $this->m_usergroup->group_array();
        $this->load->view('users/edit', $this->data);
    }

    /**
     * Change status
     */
    function status() {
        echo json_encode(array('result' => $this->m_users->status()));
    }

    function update() {
        //echo $this->m_users->update();
        echo json_encode(array('result' => $this->m_users->update()));
    }

    function delete() {
        echo json_encode(array('result' => $this->m_users->delete()));
    }

    function changepass() {
        echo json_encode(array('result' => $this->m_users->changePassword()));
    }

    function lists() {

        $this->data['title'] = 'បង្ហាញ​អ្នក​ប្រើប្រាស់';
        $this->data['data'] = $this->m_users->getUsers();
        $this->load->view(TEMPLATE, $this->data);
    }

    function loginout() {
        $this->session->sess_destroy();
        redirect('users/login');
    }

    function profile() {
        allows(array('administrator'));
        $this->load->view('users/profile', $this->data);
    }

    function table() {
        $this->load->view(TEMPLATE, $this->data);
    }

    function calendar() {
        $this->load->view(TEMPLATE, $this->data);
    }

}

?>
