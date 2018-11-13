<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        //cek status login
        if ($this->session->userdata('login') == FALSE)
        {
            redirect ('login');
        }
    }

    public function getInput()
    {
        $input = $this->input->post('data');
        return $input;
    }
}
