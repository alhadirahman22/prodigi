<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// IF Login MY_Controller
class Dashboard extends MY_Controller { 
	
	public function __construct()
 	{
 		parent::__construct();
 	}
	
	public function index()
	{
		$this->data['main_view'] =  "Dashboard/dashboard";
 		$this->load->view('template',$this->data);
	}

	public function changepassUser()
 	{
 		$this->changepass();
 	}

 	public function submitchangepassUser()
 	{
 		$this->submitchangepass();
 	}
}
