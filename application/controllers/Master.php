<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// IF Login MY_Controller
class Master extends MY_Controller { 
	public $data = array();
	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('function_model','fungsi',TRUE);
 		$this->load->model('query_model','query',TRUE);
		$this->load->model('administrator_model','adm',TRUE);
 	}

 	public function index()
	{
		$this->data['main_view'] =  "master\page";
		$this->data['user_management'] = 'active';
		$this->load->view('template',$this->data);
	}

	public function Page()
	{
	  $arr_result = array('html' => '','jsonPass' => '');
	  $uri = $this->uri->segment(2);
	  $content = $this->load->view('master/'.$uri,$this->data,true);
	  $arr_result['html'] = $content;
	  echo json_encode($arr_result);
	}

	public function upload_master()
	{
	   $TypeTelcoMaster = $this->input->post('TypeTelcoMaster');
	   $table = 'master_'.$TypeTelcoMaster;
	   $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	   $fileName = $this->input->post('fileMaster', TRUE);
	   $config['upload_path'] = './excel/'; 
	   $config['file_name'] = $fileName;
	   $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
	   $config['max_size'] = 10000;

	   $this->load->library('upload', $config);
	   $this->upload->initialize($config); 
	   
	   if (!$this->upload->do_upload('fileMaster')) {
	    $error = array('error' => $this->upload->display_errors());
	    $this->session->set_flashdata('msg','Ada kesalahan dalam upload'); 
	    redirect(''); 
	   } else {
	    $media = $this->upload->data();
	    $inputFileName = 'excel/'.$media['file_name'];
	    
	    try {
	     $inputFileType = IOFactory::identify($inputFileName);
	     $objReader = IOFactory::createReader($inputFileType);
	     $objPHPExcel = $objReader->load($inputFileName);
	    } catch(Exception $e) {
	     die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
	    }

	    $sheet = $objPHPExcel->getSheet(0);
	    $highestRow = $sheet->getHighestRow();
	    $highestColumn = $sheet->getHighestColumn();


	    $arr_result = array();
	    // print_r($highestRow);die();
	    for ($row = 2; $row <= $highestRow; $row++){  
	      $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
	        NULL,
	        TRUE,
	        FALSE);
	      $Co_singer = trim($rowData[0][1]);
	      // print_r($Co_singer);die();
	      $Co_title = trim($rowData[0][0]);
	      $RevenueProdigi = trim($rowData[0][2]);
	      $SharePartner = trim($rowData[0][3]);
	      $ShareProdigi = trim($rowData[0][4]);
	      $RoyaltiArtis = trim($rowData[0][5]);
	      $RoyalPencipta = trim($rowData[0][6]);
	      $arr_chk = array(
	       'RevenueProdigi' => $RevenueProdigi,
	       'SharePartner' => $SharePartner,
	       'ShareProdigi' => $ShareProdigi,
	       'RoyaltiArtis' => $RoyaltiArtis,
	       'RoyalPencipta' => $RoyalPencipta,
	      );
	      $keyObj = array('','Co_singer','Co_title','RevenueProdigi','SharePartner','ShareProdigi','RoyaltiArtis','RoyalPencipta');
	      if ($RevenueProdigi == "" || $SharePartner == "" || $ShareProdigi == "" || $RoyaltiArtis == "" || $RoyalPencipta == "") {
	        for ($i=$row + 1; $i <= $highestRow ; $i++) { 
	           $rowDataSearch = $sheet->rangeToArray('A' . $i . ':' . $highestColumn . $i,
	             NULL,
	             TRUE,
	             FALSE);
	           if (strtolower(trim($Co_singer))  == strtolower(trim($rowDataSearch[0][1]))  && strtolower(trim($rowData[0][0]))  == strtolower(trim($rowDataSearch[0][0])) ) {
	             $objNo = 0;
	             $KurArr = 2;
	             foreach ($arr_chk as $key => $value) {
	               if ($value == "" || $value == null) {
	                 $KeyNo = $objNo + $KurArr;
	                 $arr_chk[$key] = $rowDataSearch[0][$KeyNo];
	               }
	               $objNo++;
	             }

	             $find = true;
	             foreach ($arr_chk as $key => $value) {
	               if ($value == "" || $value == null) {
	                 $find = false;
	               }
	             }

	             if ($find) {
	               break;
	             }
	             
	           }
	           else
	           {
	             break;
	           }
	           $row = $i;
	        }
	      }

	      foreach ($arr_chk as $key => $value) {
	        if ($value == "" || $value == null) {
	          if ($key == 'RevenueProdigi') {
	            if ($table == 'master_telkom') {
	              $arr_chk[$key] = 0;
	            } else {
	              $arr_chk[$key] = 100;
	            }
	          } else {
	            $arr_chk[$key] = 0;
	          }
	          
	        }
	        
	      }
	      
	      $data_Save = array(
	       'Co_singer' => $Co_singer,
	       'Co_title' => $Co_title,
	      );
	      $arr_result[] = $data_Save + $arr_chk;
	    }
	    $this->db->insert_batch($table,$arr_result);
	    echo json_encode(array('status'=> 1,'msg' => 'Berhasil upload ...!!'));
	  }
	}
}
