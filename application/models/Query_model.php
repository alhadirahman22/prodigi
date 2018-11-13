<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Query_Model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function showData($tabel)
	{
		$sql = "select * from ".$tabel; 
		$query=$this->db->query($sql, array());
		return $query->result_array();
	}

	public function showDataActive($tabel)
	{
		$sql = "select * from ".$tabel." where active = 1"; 
		$query=$this->db->query($sql, array());
		return $query->result_array();
	}

	public function showDataActive_orderby($tabel,$field_order_by,$order_by)
	{
		$sql = "select * from ".$tabel." where active = 1"." ORDER BY ".$field_order_by." ".$order_by; 
		$query=$this->db->query($sql, array());
		return $query->result_array();
	}

	public function caribasedprimary($tabel,$primary,$fieldPrimary)
	{
		$sql = "select * from ".$tabel." where ".$primary." = ?"; 
		$query=$this->db->query($sql, array($fieldPrimary));
		return $query->result_array();
	}

	public function loadDataUser()
	{
		$sql = "select * from user where ID != 1"; 
		$query=$this->db->query($sql, array());
		return $query->result_array();
	}

	public function getActive_id_activeAll_table($ID,$Active,$table)
	{
	  if ($Active == 0) {
	    $sql = "update ".$table." set Active = 1 where ID = ".$ID;
	  }
	  else
	  {
	    $sql = "update ".$table." set Active = 0 where ID = ".$ID;
	  }
	  $query=$this->db->query($sql, array());
	}

	public function delete_id_table($ID,$table)
	{
	  $sql = "delete from ".$table." where ID = ".$ID;
	  $query=$this->db->query($sql, array());
	}
	
}
