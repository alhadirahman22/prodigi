<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Impdata extends CI_Controller {
    function __construct(){
  parent::__construct();
          
    }

 public function index() {
    $this->load->view('form/db_upload');
 }

 public function upload(){
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
     $sumVascode = 0;
     $sumTrafic = 0;
     $co_sing = $rowData[0][7];
     $vas_code = $rowData[0][5];
     // $vas_code = str_replace('rbt', '', $vas_code);
     $vas_code1 = $this->searchNumeric($vas_code);
     $sumVascode = $sumVascode + $vas_code1;
     $sumTrafic = $sumTrafic + $rowData[0][2];
     $contentTitle = $rowData[0][6];
     for ($i=$row + 1; $i <= $highestRow ; $i++) { 
        $rowDataSearch = $sheet->rangeToArray('A' . $i . ':' . $highestColumn . $i,
          NULL,
          TRUE,
          FALSE);
        if ($co_sing == $rowDataSearch[0][7] && $rowData[0][6] == $rowDataSearch[0][6]) {
          $vas_code = $rowDataSearch[0][5];
          $vas_code = $this->searchNumeric($vas_code);
          if ($vas_code != 0) {
            $sumVascode = $sumVascode + $vas_code;
            $sumTrafic = $sumTrafic + $rowDataSearch[0][2];
          }
          
          
          // print_r($sumVascode.';'.$sumTrafic);
          // die();
        }
        else
        {
          break;
        }
        $row = $i;
     }

     $r_artis = $rowData[0][13];
     $r_pencipta = $rowData[0][14];
     $result_r_artis = ($r_artis != "" || $r_artis != null) ? (((int) $sumVascode * $sumTrafic) * $rowData[0][9]) * $r_artis : '';
     $result_r_pencipta = ($r_pencipta != "" || $r_pencipta != null) ? (((int) $sumVascode * $sumTrafic) * $rowData[0][9]) * $r_pencipta : '';
     $temp = array($co_sing,
      array(
          'contentTitle' => $contentTitle,
          'sumVascode' => $sumVascode,
          'sumTrafic' => $sumTrafic,
          'row' => $row,
          'result_r_prodigi' => ((int) $sumVascode * $sumTrafic) * $rowData[0][9],
          'result_shareP' => (((int) $sumVascode * $sumTrafic) * $rowData[0][9]) * $rowData[0][11],
          'result_shareProdi' => (((int) $sumVascode * $sumTrafic) * $rowData[0][9]) * $rowData[0][12],
          'result_r_artis' => $result_r_artis,
          'result_r_pencipta' => $result_r_pencipta,
            ),
      );

     $arr_result[] = $temp;
     $data_Save = array(
      'Co_singer' => $co_sing,
      'Co_title' => $contentTitle,
      'Detail' => json_encode($temp),
     );
    // $this->db->insert("proses",$data_Save);

     // $aa = ((int) $rowData[0][2] * $vas_code) * $rowData[0][9];
     // // $rev_pro = $this->percent($rowData[0][9]);
     // $result_shareP = $aa * $rowData[0][11];
     // $result_shareProdi = $aa * $rowData[0][12];
     // $r_artis = $rowData[0][13];
     // $r_pencipta = $rowData[0][14];
     // $result_r_artis = ($r_artis != "" || $r_artis != null) ? $aa * $r_artis : '';
     // $result_r_pencipta = ($r_pencipta != "" || $r_pencipta != null) ? $aa * $r_pencipta : '';
     // $arr = array(
     //    'aa' => $aa,
     //    'result_shareP' => $result_shareP,
     //    'result_shareProdi' => $result_shareProdi,
     //    'result_r_artis' => $result_r_artis,
     //    'result_r_pencipta' => $result_r_pencipta,
     //  );
     // print_r($arr);die();
   //   $data = array(
   //   "song_id"=> $rowData[0][0],
   //   "con_id"=> $rowData[0][1],
   //   "tot_tra"=> $rowData[0][2],
   //   "price"=> $rowData[0][3],
   //   "tot_rev"=> $rowData[0][4],
   //   "vas_code"=> $rowData[0][5],
   //   "co_title"=> $rowData[0][6],
   //   "co_sing"=> $rowData[0][7],
   //   "cp_name"=> $rowData[0][8],  
   //   "rev_pro"=> $rowData[0][9],
   //   "part_name"=> $rowData[0][10],
   //   "s_part"=> $rowData[0][11],
   //   "s_pro"=> $rowData[0][12],
   //   "r_artis"=> $rowData[0][13],
   //   "r_pencipta"=> $rowData[0][14],
   //   "mark_cha"=> $rowData[0][15]
   //  );
   //  $this->db->insert("ba",$data);
   // } 
   // $this->session->set_flashdata('msg','Berhasil upload ...!!'); 
   // redirect('');
   }
   $data['data'] = $arr_result;
   $this->load->view('show',$data);
   // print_r($arr_result);
   // die(); 
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

  $sql = 'select * from proses where Co_singer = ? and Co_title = ?';
  $query = $this->db->query($sql,array($Co_singer,$Co_title))->result_array();
  if (count($query) > 0) {
    $Detail = $query[0]['Detail'];
    $Detail = json_decode($Detail);
    $Detail = $Detail[1];
    // $temp = array($co_sing,
    //  array(
    //      'contentTitle' => $contentTitle,
    //      'sumVascode' => $sumVascode,
    //      'sumTrafic' => $sumTrafic,
    //      'row' => $row,
    //      'result_r_prodigi' => ((int) $sumVascode * $sumTrafic) * $rowData[0][9],
    //      'result_shareP' => (((int) $sumVascode * $sumTrafic) * $rowData[0][9]) * $rowData[0][11],
    //      'result_shareProdi' => (((int) $sumVascode * $sumTrafic) * $rowData[0][9]) * $rowData[0][12],
    //      'result_r_artis' => $result_r_artis,
    //      'result_r_pencipta' => $result_r_pencipta,
    //        ),
    //  );
    // print_r($Detail->result_shareP);die();
    $excel3->setCellValue('F12', $Co_singer);
    $excel3->setCellValue('F13', $Co_title); 
    $excel3->setCellValue('I15', $Detail->result_shareP); 
    $excel3->setCellValue('I16', $Detail->result_shareProdi); 
    $excel3->setCellValue('I17', $Detail->result_r_artis); 
    $excel3->setCellValue('I18', $Detail->result_r_pencipta); 

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
}
 