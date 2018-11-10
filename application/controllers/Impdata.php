<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Impdata extends CI_Controller {
    function __construct(){
          parent::__construct();
          $this->load->model('m_master');
    }

 public function index() {
    $this->load->view('form/db_upload');
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
     $this->session->set_flashdata('msg','Berhasil upload ...!!'); 
     redirect('');
   }
 }

 public function upload(){
  $TypeTelcoData = $this->input->post('TypeTelcoData');
  $table = 'proses_'.$TypeTelcoData;
  $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
  $fileName = $this->input->post('file', TRUE);
  $config['upload_path'] = './excel/'; 
  $config['file_name'] = $fileName;
  $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
  $config['max_size'] = 10000;

  $this->load->library('upload', $config);
  $this->upload->initialize($config); 
  
  if (!$this->upload->do_upload('file')) {
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

   }
   // $data['data'] = $arr_result;
   // $this->load->view('show',$data);
   // print_r($arr_result);
   // die(); 
   $this->session->set_flashdata('msg','Berhasil upload ...!!'); 
   redirect('');
  } 
  
 }

 public function searchNumeric($string)
 {
  $len = strlen($string);
  $a = 0;
  $value = 0;
  for ($i=0; $i < $len; $i++) {
    $start = ($i != 0) ? $i - 1 : 0;
    // $length =  ($i != 0) ? $i - 1 : 0;
    if (is_numeric(substr($string, $start,1)))
    {
      $a = $i;
      break;
    }
  }

  $value = substr($string, $a-1,($len - $a+1));
  return $value;

 } 

 public function percent($string)
 {
  // print_r($string)
  $value = $string;
  if (!(float)$string == $string) {
    $aa = strpos($string, '%');
    $value = substr($string, 0,$aa);
    $value = $value / 100 ;
  }
  return $value;
 }

 public function expExcel()
 {
  $TypeTelcoExport = $this->input->post('TypeTelcoExport');
  $table = 'proses_'.$TypeTelcoExport;
  include APPPATH.'third_party/PHPExcel/PHPExcel.php';
  $excel2 = PHPExcel_IOFactory::createReader('Excel2007');
  $excel2 = $excel2->load('BA.xlsx'); // Empty Sheet
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
  
  
  if (count($query) > 0) {
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
    // We'll be outputting an excel file  
    header('Content-type: application/vnd.ms-excel'); // jalan ketika tidak menggunakan ajax
    // It will be called file.xlss
    header('Content-Disposition: attachment; filename="file.xlsx"'); // jalan ketika tidak menggunakan ajax
    //$filename = 'PenerimaanPembayaran.xlsx';
    //$objWriter->save('./document/'.$filename);
    $objWriter->save('php://output'); // jalan ketika tidak menggunakan ajax

  } else {
    $this->session->set_flashdata('msg','Failed'); 
    redirect('');
  }

 }

 public function clearDB()
 {
  $sql = "show tables like '%proses%'";
  $query=$this->db->query($sql, array())->result_array();
  foreach ($query as $key) {
    foreach ($key as $keya => $value) {
      $sql = "TRUNCATE TABLE ".$value;
      $query=$this->db->query($sql, array());
    }
  }

  $this->session->set_flashdata('msg','Finish'); 
  redirect('');
 }
}
 