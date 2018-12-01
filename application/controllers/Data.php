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
		$config['upload_path'] = './filedownload/'; 
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
		 $inputFileName = 'filedownload/'.$media['file_name'];
		 $filePath = $media['file_path'];
		 $filename_uploaded = $media['file_name'];
		 $mediafile_name = strtolower($media['file_name']);
		 $mediafile_name = str_replace('template','t', $mediafile_name);
		 $filenameNew = '_import_data_'.$TypeTelcoData.'_'.$this->session->userdata('Name').'_'.date('YmdHis').'_'.$mediafile_name;
		 // rename file
		 $old = $filePath.'/'.$filename_uploaded;
		 $new = $filePath.'/'.$filenameNew;
		 rename($old, $new);
		 $inputFileName = 'filedownload/'.$filenameNew;
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
		    $co_sing = trim($rowData[0][7]);
		    $Price = $rowData[0][4];
		    $contentTitle = trim($rowData[0][6]);
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
		    $PriceMarketingChanel = $Detail->PriceMarketingChanel;

		    $nestedData[] = $PriceRevenueProdigi;
		    $nestedData[] = $PriceSharePartner;
		    $nestedData[] = $PriceShareProdigi;
		    $nestedData[] = $PriceRoyaltiArtis;
		    $nestedData[] = $PriceRoyalPencipta;
		    $nestedData[] = $PriceMarketingChanel;
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
		$Pencipta = $this->input->post('Pencipta');
		$Partner = $this->input->post('Partner');
		$Artis = $this->input->post('Artis');
		$NmChanel = $this->input->post('NmChanel');

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
		$PriceMarketingChanel =  0;
		$postdata = $_POST;
		// if ($Co_title == "" || $Co_title == null) {
		//   $sql = 'select * from '.$table.' where Co_singer = ?';
		//   $query = $this->db->query($sql,array($Co_singer))->result_array();
		// } elseif ($Co_title != "" || $Co_title != null) {
		//   $sql = 'select * from '.$table.' where Co_singer = ? and Co_title = ?';
		//   $query = $this->db->query($sql,array($Co_singer,$Co_title))->result_array();
		// } 
		// else
		// {
		//   $query = array();
		// }
		$where = '';
		foreach ($postdata as $key => $value) {
		    if ($value != '') {
		    	if ($key != 'TypeTelcoExport') {
		    		if ($key == 'co_sing') {
		    		    $where .= ' where a.Co_singer = "'.$value.'"';
		    		}
		    		elseif($key == 'co_title')
		    		{
		    		    $where .= ' and a.Co_title = "'.$value.'"';
		    		}
		    		else
		    		{
		    		    $where .= ' and b.'.ucfirst($key).' = "'.$value.'"';
		    		}
		    	}
	            
		        
		    }
		}

		$sql = 'select a.*,b.Pencipta,b.Partner,b.Artis,b.NmChanel from proses_'.$TypeTelcoExport.' as a join
		        master_'.$TypeTelcoExport.' as b on a.Co_singer = b.Co_singer
		        and a.Co_title = b.Co_title
		        '.$where.'
		        
		';

		$query = $this->db->query($sql)->result_array();
		
		
		// if (count($query) > 0) {
		  for ($i=0; $i < count($query); $i++) { 
		    $Detail = $query[$i]['Detail'];
		    $Detail = json_decode($Detail);
		    
		    $PriceSharePartner = $PriceSharePartner + $Detail->PriceSharePartner;
		    $PriceShareProdigi = $PriceShareProdigi + $Detail->PriceShareProdigi;
		    $PriceRoyaltiArtis = $PriceRoyaltiArtis + $Detail->PriceRoyaltiArtis;
		    $PriceRoyalPencipta = $PriceRoyalPencipta + $Detail->PriceRoyalPencipta;
		    $PriceMarketingChanel =  $PriceMarketingChanel + $Detail->PriceMarketingChanel;
		  }
		  
		  // get two comma
		  	 $PriceSharePartner = number_format((float)$PriceSharePartner, 2, '.', '');
		  	 $PriceShareProdigi = number_format((float)$PriceShareProdigi, 2, '.', '');
		  	 $PriceRoyaltiArtis = number_format((float)$PriceRoyaltiArtis, 2, '.', '');
		  	 $PriceRoyalPencipta = number_format((float)$PriceRoyalPencipta, 2, '.', '');
		  	 $PriceMarketingChanel = number_format((float)$PriceMarketingChanel, 2, '.', '');

		  $excel3->setCellValue('F12', $Co_singer);
		  $excel3->setCellValue('F13', $Co_title); 
		  $excel3->setCellValue('F14', $Partner); 
		  $excel3->setCellValue('F15', $Pencipta); 
		  $excel3->setCellValue('F16', $NmChanel); 
		  
		  $excel3->setCellValue('I18', $PriceSharePartner); 
		  //$excel3->setCellValue('I16', $PriceShareProdigi); 
		  $excel3->setCellValue('I19', $PriceRoyaltiArtis); 
		  $excel3->setCellValue('I20', $PriceRoyalPencipta); 
		  $excel3->setCellValue('I21', $PriceMarketingChanel); 

		  $objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');

		  // another sheet
		  $excel2->setActiveSheetIndex(1);
		  $excel4 = $excel2->getActiveSheet();
		  $a = 2;
		  for ($i=0; $i < count($query); $i++) { 
		  	$no = $i + 1;
		  	 $excel4->setCellValue('A'.$a, $no); 
		  	 $excel4->setCellValue('B'.$a, $query[$i]['Co_singer']); 
		  	 $excel4->setCellValue('C'.$a, $query[$i]['Co_title']); 
		  	 $excel4->setCellValue('D'.$a, $query[$i]['Pencipta']); 
		  	 $excel4->setCellValue('E'.$a, $query[$i]['Partner']); 
		  	 $excel4->setCellValue('F'.$a, $query[$i]['Artis']); 
		  	 $excel4->setCellValue('G'.$a, $query[$i]['NmChanel']);
		  	 $Detail = $query[$i]['Detail'];
		  	 $Detail = json_decode($Detail);
		  	 
		  	 $PriceSharePartner = $Detail->PriceSharePartner;
		  	 $PriceShareProdigi =$Detail->PriceShareProdigi;
		  	 $PriceRoyaltiArtis = $Detail->PriceRoyaltiArtis;
		  	 $PriceRoyalPencipta = $Detail->PriceRoyalPencipta;
		  	 $PriceMarketingChanel =  $Detail->PriceMarketingChanel;
		  	 $PriceRevenueProdigi =  $Detail->PriceRevenueProdigi;

		  	 $excel4->setCellValue('H'.$a, number_format((float)$PriceRevenueProdigi, 2, '.', '')); 
		  	 $excel4->setCellValue('I'.$a, number_format((float)$PriceShareProdigi, 2, '.', '')); 
		  	 $excel4->setCellValue('J'.$a, number_format((float)$PriceSharePartner, 2, '.', '')); 
		  	 $excel4->setCellValue('K'.$a, number_format((float)$PriceRoyaltiArtis, 2, '.', '')); 
		  	 $excel4->setCellValue('L'.$a, number_format((float)$PriceRoyalPencipta, 2, '.', '')); 
		  	 $excel4->setCellValue('M'.$a, number_format((float)$PriceMarketingChanel, 2, '.', ''));

		  	 $excel4->getStyle('A'.$a)->applyFromArray($style_row);
             $excel4->getStyle('B'.$a)->applyFromArray($style_row);
             $excel4->getStyle('C'.$a)->applyFromArray($style_row);
             $excel4->getStyle('D'.$a)->applyFromArray($style_row);
             $excel4->getStyle('E'.$a)->applyFromArray($style_row);
             $excel4->getStyle('F'.$a)->applyFromArray($style_row);
             $excel4->getStyle('G'.$a)->applyFromArray($style_row);
             $excel4->getStyle('H'.$a)->applyFromArray($style_row);
             $excel4->getStyle('I'.$a)->applyFromArray($style_row);
             $excel4->getStyle('J'.$a)->applyFromArray($style_row);
             $excel4->getStyle('K'.$a)->applyFromArray($style_row);
             $excel4->getStyle('L'.$a)->applyFromArray($style_row);
             $excel4->getStyle('M'.$a)->applyFromArray($style_row);
             $a = $a + 1;  
		  }

		  foreach(range('A','Z') as $columnID) {
              $excel2->getActiveSheet()->getColumnDimension($columnID)
                  ->setAutoSize(true);
          }
		  $Filename = '_Export_'.$TypeTelcoExport.'_'.$this->session->userdata('Name').'_'.date('YmdHis').'_'.$Co_singer.'-'.$Co_title.'.xlsx';
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

	public function Autocompleteco_sing()
	{
		$Nama = $this->input->post('Nama');
		$TypeTelcoExport = $this->input->post('TypeTelcoExport');
       $data['response'] = 'true'; //mengatur response
       $data['message'] = array(); //membuat array
       $getData = $this->m_master->getAllco_singAutoComplete($Nama,$TypeTelcoExport);
       for ($i=0; $i < count($getData); $i++) {
           $data['message'][] = array(
               'label' => $getData[$i]['Co_singer'],
               'value' => $getData[$i]['Co_singer']
           );
       }
       echo json_encode($data);
	}

	public function Autocomplete_search(){
		$value = $this->input->post('Nama');
		$field = $this->input->post('attrname');
		$postdata = $this->input->post('postdata');
		$TypeTelcoExport = $this->input->post('TypeTelcoExport');
       $data['response'] = 'true'; //mengatur response
       $data['message'] = array(); //membuat array
       $getData = $this->m_master->getAllAutoComplete($value,$TypeTelcoExport,$field,$postdata);
       for ($i=0; $i < count($getData); $i++) {
           $data['message'][] = array(
               'label' => $getData[$i][ucfirst($field)],
               'value' => $getData[$i][ucfirst($field)]
           );
       }
       echo json_encode($data);
	}

	public function getAllFile()
	{
		$dir    = getcwd().'/filedownload';
		$arr_result = array();
		if ($handle = opendir($dir)) {
			$no = 0;
		    while (false !== ($entry = readdir($handle))) {

		        if ($entry != "." && $entry != ".." && strpos(strtolower($entry),strtolower('index')) === false && strpos(strtolower($entry),strtolower('template')) === false) {
		        	$no++;
		        	$temp = array(
		        		'No' => $no,
		        		'File'=> '<a href = "'.base_url().'filedownload/'.$entry.'" >'.$entry.'</a>&nbsp<button type="button" class="btn btn-xs btn-danger btn-delete-file" dir = "'.$dir.'/'.$entry.'"> <i class="fa fa-trash" aria-hidden="true"></i></button>',
		        		'Delete' => '<button type="button" class="btn btn-xs btn-danger btn-delete-file" dir = "'.$dir.'/'.$entry.'"> <i class="fa fa-trash" aria-hidden="true"></i></button>',
		        		);
		            $arr_result[] = $temp;
		            
		        }
		    }

		    closedir($handle);

		}
		echo json_encode($arr_result);
	}
}
