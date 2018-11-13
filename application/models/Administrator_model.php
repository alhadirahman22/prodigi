<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function inserData_user($Username,$Name,$Password,$level)
    {
        $dataSave = array(
                'Username' => $Username,
                'Password' => md5(sha1($Password)),
                'Name' => $Name,
                'Auth' => $level
        );
        $this->db->insert('user', $dataSave);
    }

    public function editData_user($Username,$Name,$Password,$level,$ID)
    {
        $dataSave = array(
                'Username' => $Username,
                'Password' => md5(sha1($Password)),
                'Name' => $Name,
                'Auth' => $level
        );
        $this->db->where('ID', $ID);
        $this->db->update('user', $dataSave);
    }
    

}
