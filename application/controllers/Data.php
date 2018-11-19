<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// IF Login MY_Controller
class Data extends MY_Controller { 
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
		$this->data['main_view'] =  "data\page";
		$this->load->view('template',$this->data);
	}

	public function Page()
	{
	  $arr_result = array('html' => '','jsonPass' => '');
	  $uri = $this->uri->segment(2);
	  // get master
	  // $this->data['dtmastertype'] = $this->m_master->dtmastertype();
	  $content = $this->load->view('data/'.$uri,$this->data,true);
	  $arr_result['html'] = $content;
	  echo json_encode($arr_result);
	}

	public function upload_data()
	{
		$TypeTelcoData = $this->input->post('TypeTelcoData');
		$table = 'proses_'.$TypeTelcoData;
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$fileName = $this->input->post('fileData', TRUE);
		$config['upload_path'] = './excel/'; 
		$config['file_name'] = $fileName;
		$config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
		$config['max_size'] = 10000;

		$this->load->library('upload', $config);
		$this->upload->initialize($config); 
		
		if (!$this->upload->do_upload('fileData')) {
		 $error = array('error' => $this->upload->display_errors());
		 // $this->session->set_flashdata('msg','Ada kesalahan dalam upload'); 
		 // redirect(''); 
		 echo json_encode(array('status'=> 0,'msg' => $error));
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
		    $temp = array();
		    $co_sing = $rowData[0][7];
		    $Price = $rowData[0][4];
		    $contentTitle = $rowData[0][6];
		    for ($i=$row + 1; $i <= $highestRow ; $i++) { 
		       $rowDataSearch = $sheet->rangeToArray('A' . $i . ':' . $highestColumn . $i,
		         NULL,
		         TRUE,
		         FALSE);
		       if ($co_sing == $rowDataSearch[0][7] && $rowData[0][6] == $rowDataSearch[0][6]) {
		         $Price = $Price + $rowDataSearch[0][4];
		       }
		       else
		       {
		         break;
		       }
		       $row = $i;
		    }

		    //  get PriceVenueProdigi
		    $getResult = $this->m_master->getResult($Price,$co_sing,$contentTitle,$TypeTelcoData);

		    $arr_result[] = array(
		     'Co_singer' => $co_sing,
		     'Co_title' => $contentTitle,
		     'Detail' => $getResult,
		    );
		    $data_Save = array(
		     'Co_singer' => $co_sing,
		     'Co_title' => $contentTitle,
		     'Detail' => json_encode($getResult),
		    );
		   $this->db->insert($table,$data_Save);

		  } // exit loop
		  	// rename file
		  	$old = $filePath.'/'.$filenameNew;
		  	$new = $filePath.'/'.'_success_'.$filenameNew;
		  	rename($old, $new);
		  	echo json_encode(array('status'=> 1,'msg' => 'Berhasil upload ...!!'));
		 } catch(Exception $e) {
		 	echo json_encode(array('status'=> 1,'msg' => 'Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage()));
		 }
		 
		} // end upload file success 
	}

	public function datadata()
	{
		$TypeData = $this->input->post('TypeData');
		$auth = $this->input->post('auth');
		$tbl = 'proses_'.$TypeData;
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
		    $Detail = json_decode($row['Detail']);
		    $PriceRevenueProdigi = $Detail->PriceRevenueProdigi;
		    $PriceSharePartner = $Detail->PriceSharePartner;
		    $PriceShareProdigi = $Detail->PriceShareProdigi;
		    $PriceRoyaltiArtis = $Detail->PriceRoyaltiArtis;
		    $PriceRoyalPencipta = $Detail->PriceRoyalPencipta;

		    $nestedData[] = $PriceRevenueProdigi;
		    $nestedData[] = $PriceSharePartner;
		    $nestedData[] = $PriceShareProdigi;
		    $nestedData[] = $PriceRoyaltiArtis;
		    $nestedData[] = $PriceRoyalPencipta;
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

	public function datadata_submit()
	{
		$data = $this->input->post('data');
		$msg = '';
		switch ($data['Action']) {
			case 'add':
				$FormInsert =  $data['FormInsert'];
				// print_r($FormInsert);
				foreach ($FormInsert as $key) {
					$dataSave = array();
					$ID = '';
					$Detail = array();
					foreach ($key as $keya => $value) {
						if ($keya != 'ID') {
							if ($keya  != 'Co_singer' && $keya  != 'Co_title') {
								$Detail[$keya] = $value;
							}
							else
							{
								$dataSave[$keya] = $value;
							}
							
						}
						else
						{
							$ID = $value;
						}
						
					}
					$dataSave['Detail'] = json_encode($Detail);
					// print_r($dataSave);
					$this->db->insert('proses_'.$data['TypeData'], $dataSave);
				}
				echo json_encode($msg);
				break;
			case 'edit':
				$FormUpdate =  $data['FormUpdate'];
				foreach ($FormUpdate as $key) {
					$dataSave = array();
					$ID = '';
					$Detail = array();
					foreach ($key as $keya => $value) {
						if ($keya != 'ID') {
							if ($keya  != 'Co_singer' && $keya  != 'Co_title') {
								$Detail[$keya] = $value;
							}
							else
							{
								$dataSave[$keya] = $value;
							}
							
						}
						else
						{
							$ID = $value;
						}
						
					}
					$dataSave['Detail'] = json_encode($Detail);
					$this->db->where('ID', $ID);
					$this->db->update('proses_'.$data['TypeData'], $dataSave);
				}
				echo json_encode($msg);
				break;
			case 'delete':
				$ID = $data['CDID'];
				$table = 'proses_'.$data['TypeData'];
				$this->m_master->delete_id_table_all_db($ID,$table);
			break;
			case 'cleartbl':
				$table = 'proses_'.$data['TypeData'];
				$sql = "TRUNCATE TABLE ".$table;
				$query=$this->db->query($sql, array());	
			break;
			default:
				# code...
				break;
		}
	}

	public function datadata_excel()
	{
		$TypeTelcoExport =  $this->input->post('TypeTelcoExport');
		$table = 'proses_'.$TypeTelcoExport;
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		$excel2 = PHPExcel_IOFactory::createReader('Excel2007');
		$excel2 = $excel2->load('filedownload/TemplateLoadExport.xlsx'); // Empty Sheet
		$excel2->setActiveSheetIndex(0);
		$Co_singer = $this->input->post('co_sing');
		$Co_title = $this->input->post('co_title');

		$excel3 = $excel2->getActiveSheet();
		// $excel3->setCellValue('A3', $GetDateNow.' Jam '.date('H:i'));

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		  'alignment' => array(
		    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
		    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		$PriceSharePartner = 0;
		$PriceShareProdigi = 0;
		$PriceRoyaltiArtis = 0;
		$PriceRoyalPencipta = 0;

		if ($Co_title == "" || $Co_title == null) {
		  $sql = 'select * from '.$table.' where Co_singer = ?';
		  $query = $this->db->query($sql,array($Co_singer))->result_array();
		} elseif ($Co_title != "" || $Co_title != null) {
		  $sql = 'select * from '.$table.' where Co_singer = ? and Co_title = ?';
		  $query = $this->db->query($sql,array($Co_singer,$Co_title))->result_array();
		} 
		else
		{
		  $query = array();
		}
		
		
		// if (count($query) > 0) {
		  for ($i=0; $i < count($query); $i++) { 
		    $Detail = $query[$i]['Detail'];
		    $Detail = json_decode($Detail);
		    
		    $PriceSharePartner = $PriceSharePartner + $Detail->PriceSharePartner;
		    $PriceShareProdigi = $PriceShareProdigi + $Detail->PriceShareProdigi;
		    $PriceRoyaltiArtis = $PriceRoyaltiArtis + $Detail->PriceRoyaltiArtis;
		    $PriceRoyalPencipta = $PriceRoyalPencipta + $Detail->PriceRoyalPencipta;
		  }
		  

		  $excel3->setCellValue('F12', $Co_singer);
		  $excel3->setCellValue('F13', $Co_title); 
		  $excel3->setCellValue('I15', $PriceSharePartner); 
		  $excel3->setCellValue('I16', $PriceShareProdigi); 
		  $excel3->setCellValue('I17', $PriceRoyaltiArtis); 
		  $excel3->setCellValue('I18', $PriceRoyalPencipta); 

		  $objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
		  $Filename = '_Export_'.$this->session->userdata('Name').'_'.date('YmdHis').'_'.$Co_singer.'-'.$Co_title.'.xlsx';
		  // We'll be outputting an excel file  
		  header('Content-type: application/vnd.ms-excel'); // jalan ketika tidak menggunakan ajax
		  // It will be called file.xlss
		  header('Content-Disposition: attachment; filename="'.$Filename.'"'); // jalan ketika tidak menggunakan ajax
		  //$filename = 'PenerimaanPembayaran.xlsx';
		  $objWriter->save('./filedownload/'.$Filename);
		  $objWriter->save('php://output'); // jalan ketika tidak menggunakan ajax

		// } else {
		//   $this->session->set_flashdata('msg','Failed'); 
		//   redirect('');
		// }
	}
}
