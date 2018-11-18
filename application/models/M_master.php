<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model {


    function __construct()
    {
        parent::__construct();
    }

    public function delete_id_table_all_db($ID,$table)
    {
        $sql = "delete from ".$table." where ID = ".$ID;
        $query=$this->db->query($sql, array());
    }
    
    public function showData($tabel)
    {
        $sql = "select * from ".$tabel;
        $query=$this->db->query($sql, array());
        return $query->result();
    }


    public function showData_array($tabel)
    {
        $sql = "select * from ".$tabel;
        $query=$this->db->query($sql, array());
        return $query->result_array();
    }

    public function showDataActive_array($tabel,$Active)
    {
        $sql = "select * from ".$tabel." where Active = ?";
        $query=$this->db->query($sql, array($Active));
        return $query->result_array();
    }

    public function showDataActive($tabel)
    {
        $sql = "select * from ".$tabel." where active = 1";
        $query=$this->db->query($sql, array());
        return $query->result();
    }

    public function caribasedprimary($tabel,$fieldPrimary,$valuePrimary)
    {
        $sql = "select * from ".$tabel." where ".$fieldPrimary." = ?";
        $query=$this->db->query($sql, array($valuePrimary));
        return $query->result_array();
    }

    public function getColumnTable($table)
    {
        $arr = array();
        $sql = "SHOW COLUMNS FROM ".$table;
        $query=$this->db->query($sql, array())->result();
        $temp = array();
        foreach ($query as $key) {
            $temp[] = $key->Field;
        }
        $arr = array('query' => $query,'field' => $temp);
        return $arr;
    }

    public function BulanInggris($MonthNumber)
    {
        $arr_bulan = array(
            'Jan','Feb','March','April','May','June','July','August','Sep','Oct','Nov','Des'
        );

        $MonthNumber = $MonthNumber - 1;
        $MonthName = '';
        try
        {
            $MonthName = $arr_bulan[$MonthNumber];
        }
        catch(Exception $ex)
        {
            $MonthName = '';
        }

        return $MonthName;
    }

    //============================ FORMATTER ============================
    public function moneySay($x) {
        $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        if ($x < 12)
            return " " . $abil[$x];
        elseif ($x < 20)
            return $this->moneySay($x - 10) . "belas";
        elseif ($x < 100)
            return $this->moneySay($x / 10) . " puluh" . $this->moneySay($x % 10);
        elseif ($x < 200)
            return " seratus" . $this->moneySay($x - 100);
        elseif ($x < 1000)
            return $this->moneySay($x / 100) . " ratus" . $this->moneySay($x % 100);
        elseif ($x < 2000)
            return " seribu" . $this->moneySay($x - 1000);
        elseif ($x < 1000000)
            return $this->moneySay($x / 1000) . " ribu" . $this->moneySay($x % 1000);
        elseif ($x < 1000000000)
            return $this->moneySay($x / 1000000) . " juta" . $this->moneySay($x % 1000000);
    }
    
    public function romawiNumber($get = NULL) {
        $rmw[1] = 'I';
        $rmw[2] = 'II';
        $rmw[3] = 'III';
        $rmw[4] = 'IV';
        $rmw[5] = 'V';
        $rmw[6] = 'VI';
        $rmw[7] = 'VII';
        $rmw[8] = 'VIII';
        $rmw[9] = 'IX';
        $rmw[10] = 'X';
        $rmw[11] = 'XI';
        $rmw[12] = 'XII';
        
        if (is_null($get)) {
            return $rmw;
        }
        else {
            return $rmw[intval($get)];
        }
    }

    public function dateDiffDays ($d1, $d2) {   
    // Return the number of days between the two dates:

      return round(abs(strtotime($d1)-strtotime($d2))/86400);

    }  // end function dateDiff

    public function getResult($Price,$co_sing,$contentTitle,$TypeTelcoData)
    {
        $arr_result = array(
            'PriceRevenueProdigi' => 0,
            'PriceSharePartner' => 0,
            'PriceShareProdigi' => 0,
            'PriceRoyaltiArtis' => 0,
            'PriceRoyalPencipta' => 0,
            'PriceRevenueProdigiKurang' => 0,
        );
        $sql = 'select * from master_'.$TypeTelcoData.' where Co_singer = ? and Co_title = ? limit 1';
        $query=$this->db->query($sql, array($co_sing,$contentTitle))->result_array();
        if (count($query) > 0) {
            $RevenueProdigi = $query[0]['RevenueProdigi'];
            $SharePartner = $query[0]['SharePartner'];
            $ShareProdigi = $query[0]['ShareProdigi'];
            $RoyaltiArtis = $query[0]['RoyaltiArtis'];
            $RoyalPencipta = $query[0]['RoyalPencipta'];
            $PriceRevenueProdigi = $Price * $RevenueProdigi;
            if ($TypeTelcoData == 'telkom') {
                if ($RoyaltiArtis <= 0 && $RoyalPencipta <= 0) {
                    $PriceSharePartner = $PriceRevenueProdigi * $SharePartner;
                    $PriceShareProdigi = $PriceRevenueProdigi * $ShareProdigi;
                    $PriceRoyaltiArtis = $PriceRevenueProdigi * $RoyaltiArtis;
                    $PriceRoyalPencipta = $PriceRevenueProdigi * $RoyalPencipta;
                    $PriceRevenueProdigiKurang = 'Case 1';
                } 
                elseif ($SharePartner >= 0 || $ShareProdigi >= 0 ) {
                     $PriceRoyaltiArtis = $PriceRevenueProdigi * $RoyaltiArtis;
                     $PriceRoyalPencipta = $PriceRevenueProdigi * $RoyalPencipta;
                     $PriceSharePartner = ($PriceRevenueProdigi - $PriceRoyaltiArtis) * $SharePartner;
                     $PriceShareProdigi = ($PriceRevenueProdigi - $PriceRoyaltiArtis) * $ShareProdigi;
                     $PriceRevenueProdigiKurang = 'Case 2';
                }
                elseif ($RoyaltiArtis >= 0 && $RoyalPencipta >= 0 ) {
                     $PriceRoyaltiArtis = $PriceRevenueProdigi * $RoyaltiArtis;
                     $PriceRoyalPencipta = $PriceRevenueProdigi * $RoyalPencipta;
                     $PriceSharePartner = ($PriceRevenueProdigi - ($PriceRoyaltiArtis + $PriceRoyalPencipta) ) * $SharePartner;
                     $PriceShareProdigi = ($PriceRevenueProdigi - ($PriceRoyaltiArtis + $PriceRoyalPencipta) ) * $ShareProdigi;
                     $PriceRevenueProdigiKurang = 'Case 3';
                }
                $arr_result = array(
                    'PriceRevenueProdigi' => $PriceRevenueProdigi,
                    'PriceSharePartner' => $PriceSharePartner,
                    'PriceShareProdigi' => $PriceShareProdigi,
                    'PriceRoyaltiArtis' => $PriceRoyaltiArtis,
                    'PriceRoyalPencipta' => $PriceRoyalPencipta,
                    'PriceRevenueProdigiKurang' => $PriceRevenueProdigiKurang,
                );
            } else {
                $PriceRoyaltiArtis = $PriceRevenueProdigi * $RoyaltiArtis;
                $PriceRoyalPencipta = $PriceRevenueProdigi * $RoyalPencipta;
                $PriceSharePartner = $PriceRevenueProdigi * $SharePartner;
                $PriceShareProdigi = $PriceRevenueProdigi * $ShareProdigi;
                $PriceRevenueProdigiKurang = 'Case 0';

                $arr_result = array(
                    'PriceRevenueProdigi' => $PriceRevenueProdigi,
                    'PriceSharePartner' => $PriceSharePartner,
                    'PriceShareProdigi' => $PriceShareProdigi,
                    'PriceRoyaltiArtis' => $PriceRoyaltiArtis,
                    'PriceRoyalPencipta' => $PriceRoyalPencipta,
                    'PriceRevenueProdigiKurang' => $PriceRevenueProdigiKurang,
                );
            }
            
                      
        }

        return $arr_result;
        
    }

    public function dtmastertype()
    {
        $arr = array();
        $sql = "show tables like '%master%'";
        $query=$this->db->query($sql, array())->result_array();
        foreach ($query as $key) {
          foreach ($key as $keya => $value) {
            $c = explode('_', $value);
            $arr[] = $c[1];
          }
        }

        return $arr;
    }
}