<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
	private $data = array();
	public function __construct()
   	{
        parent::__construct();
   	}

	public function load_form_rules()
	{
		$form_rules = array(
			array(
				'field'=>'username',
				'label'=>'NIK',
				'rules'=>'required'
				),
			array(
				'field'=>'password',
				'label'=>'Password',
				'rules'=>'required'
				),
			);
		return $form_rules;
	}

	public function validasi()
	{
		$form = $this->load_form_rules();
		$this->form_validation->set_rules($form);

		if ($this->form_validation->run()) {
			# code...
			return TRUE ;
		}
		else
		{
			return FALSE;
		}
	}

	//cek status user, login atau tidak ?
	public function  cek_user()
	{
		$username = trim($this->input->post('username'));
		$password = md5(sha1(trim($this->input->post('password'))));
		$sql = "select * from user where Username = ? and Password = ? and Active = 1"; 
		$query=$this->db->query($sql, array($username,$password));
		$query->result();
		if ($query->num_rows()==1) 
		{
			foreach ($query->result() as $row) {
				$this->session->set_userdata('Username',$row->Username);
				$this->session->set_userdata('Auth',$row->Auth);
				$this->session->set_userdata('Name',$row->Name);
				$this->session->set_userdata('NamaAuth',$row->Auth);
			}	
			$data  = array('login' => TRUE);
			$this->session->set_userdata($data);
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}

	public function logout()
	{
		$this->session->unset_userdata(
			array('username' => '', 'login' => FALSE));
		$this->session->sess_destroy();
	}

	public function checkpassword($username,$extpassword)
	{
		$sql = "select * from user where Username = ? and Password = ? "; 
		$query=$this->db->query($sql, array($username,$extpassword));
		return $query->result();

	}

	private function load_form_rulesPass()
    {
        $form = array(
            array(
                'field' => 'extpassword',
                'label' => 'Existing Password',
                // 'rules' => 'required|min_length[8]'
                'rules' => 'required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                // 'rules' => 'required|min_length[8]'
                'rules' => 'required'
            ),
             array(
                'field' => 'kpassword',
                'label' => 'Confirm Password',
                // 'rules' => 'required|min_length[8]'
                'rules' => 'required'
            ),
             
        );
        return $form;
    }

    public function validasiform()
    {
        $form = $this->load_form_rulesPass();
		$this->form_validation->set_rules($form);

		if ($this->form_validation->run()) {
			# code...
			return TRUE ;
		}
		else
		{
			return FALSE;
		}
    }

    public function changepassword($kpassword)
	{
		$data = array(
			'Password'=>md5(sha1($kpassword)),
			);
		$this->db->set($data)
			     ->where('Username', $this->session->userdata('Username'))
		    	 ->update('user');

	 	if ($this->db->affected_rows() > 0 )
	 	 {
	 		return TRUE;
	 	 }
	 	 else
	 	 {
	 	 	return FALSE;
	 	 }
	}

}

/* End of file login_model.php */
/* Location : ./application/models/login_model.php  */


