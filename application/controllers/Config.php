<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// IF Login MY_Controller
class Config extends MY_Controller { 
	
	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('function_model','fungsi',TRUE);
 		$this->load->model('query_model','query',TRUE);
		$this->load->model('administrator_model','adm',TRUE);
 	}

 	public function user_management()
	{
		$this->data['main_view'] =  "config\usermanagement\list_user";
		$this->data['user_management'] = 'active';
		$this->load->view('template',$this->data);
	}

	public function user_data()
	{
		$data = $this->query->loadDataUser();
		echo json_encode($data);
	}

	public function page_modal_user_data()
	{
		$input = $this->getInput();
		$this->data['action'] = $input['Action'];
		$this->data['id'] = $input['CDID'];
		if ($input['Action'] == 'edit') {
		    $this->data['getData'] = $this->query->caribasedprimary('user','ID',$input['CDID']);
		}
		echo $this->load->view('config\usermanagement\page_modal_user_data',$this->data,true);
	}

	public function userdata_action()
	{
		$input = $this->getInput();
		switch ($input['Action']) {
		    case 'add':
		        $this->adm->inserData_user($input['Username'],$input['Name'],$input['Password'],$input['level']);
		        break;
		    case 'edit':
		        $this->adm->editData_user($input['Username'],$input['Name'],$input['Password'],$input['level'],$input['CDID']);
		        break;
		    case 'delete':
		        $this->query->delete_id_table($input['CDID'],'user');
		        break;        
		    case 'getactive':
		        $this->query->getActive_id_activeAll_table($input['CDID'],$input['Active'],'user');
		        break;    
		    default:
		        # code...
		        break;
		}
	}

	public function deletefile()
	{
		$dir = $this->input->post('dir');
		unlink($dir);
	}

	public function cleardataproses()
	{
		$sql = "show tables like '%proses%'";
		$query=$this->db->query($sql, array())->result_array();
		foreach ($query as $key) {
		  foreach ($key as $keya => $value) {
		    $sql = "TRUNCATE TABLE ".$value;
		    $query=$this->db->query($sql, array());
		  }
		}
	}

}
