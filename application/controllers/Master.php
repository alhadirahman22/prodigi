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
		$this->load->model('m_master');
 	}

 	public function index()
	{
		$this->data['main_view'] =  "master\page";
		$this->load->view('template',$this->data);
	}

	public function Page()
	{
	  $arr_result = array('html' => '','jsonPass' => '');
	  $uri = $this->uri->segment(2);
	  // get master
	  // $this->data['dtmastertype'] = $this->m_master->dtmastertype();
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
	    // $error = array('error' => $this->upload->display_errors());
	    // $this->session->set_flashdata('msg','Ada kesalahan dalam upload'); 
	    // redirect(''); 
	    echo json_encode(array('status'=> 0,'msg' => 'Ada kesalahan dalam upload'));
	   } else {
	    $media = $this->upload->data();
	    $inputFileName = 'excel/'.$media['file_name'];
	    $filePath = $media['file_path'];
	    $filename_uploaded = $media['file_name'];
	    $filenameNew = $this->session->userdata('Name').'_'.date('YmdHis').'_'.$media['file_name'];
	    // rename file
	    $old = $filePath.'/'.$filename_uploaded;
	    $new = $filePath.'/'.$filenameNew;
	    rename($old, $new);
	    $inputFileName = 'excel/'.$filenameNew;
	    try {
	     $inputFileType = IOFactory::identify($inputFileName);
	     $objReader = IOFactory::createReader($inputFileType);
	     $objPHPExcel = $objReader->load($inputFileName);

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
	     } // end loop
	     $this->db->insert_batch($table,$arr_result);
	     // rename file
	     $old = $filePath.'/'.$filenameNew;
	     $new = $filePath.'/'.'_success_'.$filenameNew;
	     rename($old, $new);
	     echo json_encode(array('status'=> 1,'msg' => 'Berhasil upload ...!!'));
	    } catch(Exception $e) {
	     echo json_encode(array('status'=> 1,'msg' => 'Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage()));
	    }

	  }
	}

	public function masterdata()
	{
		$TypeData = $this->input->post('TypeData');
		$auth = $this->input->post('auth');
		$tbl = 'master_'.$TypeData;
		$requestData= $_REQUEST;
		$btn = function($auth,$ID){
			if ($auth != 'all') {
				return '';
			}
			else
			{
				return '<button type="button" class="btn btn-danger btn-delete btn-delete-post"  code = "'.$ID.'"> <i class="fa fa-trash" aria-hidden="true"></i> Delete</button>';
			}	
		};
		$condition = ' where ( Co_singer LIKE "'.$requestData['search']['value'].'%" or Co_title LIKE "'.$requestData['search']['value'].'%" 
		        )';
		$sql = 'select count(*) as total from '.$tbl.' '.$condition;
		$query = $this->db->query($sql)->result_array();
		$totalData = $query[0]['total'];
		$No = $requestData['start'] + 1;

		$sql = 'select * from '.$tbl.' '.$condition;
		$orderBYID = ($requestData['search']['value'] == "") ? ' ID Desc,' : '';
		$sql.= 'ORDER BY '.$orderBYID.' Co_singer asc,Co_title asc LIMIT '.$requestData['start'].' , '.$requestData['length'].' ';
		$query = $this->db->query($sql)->result_array();

		$data = array();
		for($i=0;$i<count($query);$i++){
		    $nestedData=array();
		    $row = $query[$i];
		    $nestedData[] = $No;
		    $nestedData[] = $row['Co_singer'];
		    $nestedData[] = $row['Co_title'];
		    $nestedData[] = ($row['RevenueProdigi'] > 1) ? ((int)($row['RevenueProdigi'])).'%': ($row['RevenueProdigi'] * 100).'%';
		    $nestedData[] = ($row['SharePartner'] * 100).'%';
		    $nestedData[] = ($row['ShareProdigi'] * 100).'%';
		    $nestedData[] = ($row['RoyaltiArtis'] * 100).'%';
		    $nestedData[] = ($row['RoyalPencipta'] * 100).'%';
		    $nestedData[] = $btn($auth,$row['ID']);
		    $nestedData[] = $row['ID'];
		    $data[] = $nestedData;
		    $No++;
		}

		$json_data = array(
		    "draw"            => intval( $requestData['draw'] ),
		    "recordsTotal"    => intval($totalData),
		    "recordsFiltered" => intval($totalData ),
		    "data"            => $data
		);
		echo json_encode($json_data);
	}

	public function masterdata_submit()
	{
		$data = $this->input->post('data');
		$msg = '';
		switch ($data['Action']) {
			case 'add':
				$FormInsert =  $data['FormInsert'];
				foreach ($FormInsert as $key) {
					$dataSave = array();
					$ID = '';
					foreach ($key as $keya => $value) {
						if ($keya != 'ID') {
							if ($keya  != 'Co_singer' && $keya  != 'Co_title') {
								$value = $value / 100 ; // for  %
							}
							$dataSave[$keya] = $value;
							
						}
						else
						{
							$ID = $value;
						}
						
					}
					$this->db->insert('master_'.$data['TypeData'], $dataSave);
				}
				echo json_encode($msg);
				break;
			case 'edit':
				$FormUpdate =  $data['FormUpdate'];
				foreach ($FormUpdate as $key) {
					$dataSave = array();
					$ID = '';
					foreach ($key as $keya => $value) {
						if ($keya != 'ID') {
							if ($keya  != 'Co_singer' && $keya  != 'Co_title') {
								$value = $value / 100 ; // for  %
							}
							$dataSave[$keya] = $value;
							
						}
						else
						{
							$ID = $value;
						}
						
					}
					$this->db->where('ID', $ID);
					$this->db->update('master_'.$data['TypeData'], $dataSave);
				}
				echo json_encode($msg);
				break;
			case 'delete':
				$ID = $data['CDID'];
				$table = 'master_'.$data['TypeData'];
				$this->m_master->delete_id_table_all_db($ID,$table);
			break;
			case 'cleartbl':
				$table = 'master_'.$data['TypeData'];
				$sql = "TRUNCATE TABLE ".$table;
				$query=$this->db->query($sql, array());	
			break;
			
			default:
				# code...
				break;
		}
	}
}
