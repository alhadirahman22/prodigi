public function generate_to_be_mhs()
    {
      $input = $this->getInputToken();
       // $this->db->query('CREATE TABLE ta_2018.docstd (
       //                        `ID`  int(11) NOT NULL ,
       //                        `NPM`  varchar(255) NULL ,
       //                        `ID_doc_checklist`  int(11) NULL ,
       //                        `Path`  varchar(255) NULL ,
       //                        PRIMARY KEY (`ID`)
       //                      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1');

      //check existing db
          // get setting ta
          $taDB = $this->m_master->showData_array('db_admission.set_ta');
          $ta = $taDB[0]['Ta'];
          $ta = 'ta_'.$ta;

           $checkDB = $this->m_master->checkDB($ta);
          if ($checkDB) {
            // create db
            $this->m_api->createDBYearAcademicNew($ta);
          }

          // search data berdasarkan ID_register_formulir
          $arrInputID = $input['checkboxArr'];
          $arr = array();
          $arr_insert_auth = array();
          $arr_insert3 = array();
          $arr_insert4 = array();
          
          for ($i=0; $i < count($arrInputID); $i++) {
            $data = $this->m_master->caribasedprimary('db_admission.register_formulir','ID',$arrInputID[$i]);
            $data2 = $this->m_admission->getDataPersonal($arrInputID[$i]);
            $ProdiID = $data[0]['ID_program_study'];
            $aa = 1;
            $bb = 1;
                $Q_getLastNPM = $this->m_master->getLastNPM($ta,$ProdiID);
                // print_r($Q_getLastNPM);
                if (count($Q_getLastNPM)== 1) {
                  $bb = $Q_getLastNPM[0]['NPM'];
                }

                $Q_Prodi = $this->m_master->caribasedprimary('db_academic.program_study','ID',$ProdiID);
                if (count($Q_getLastNPM) == 0) {
                    // search NPM dengan 2 Pertama kode Prodi CodeID
                    // 2 kedua tahun angkatan ambil 2 digit terakhir
                    $CodeID = $Q_Prodi[0]['CodeID'];
                    $strLenTA = strlen($ta) - 2; // last 2 digit
                    $P_ang = substr($ta, $strLenTA,2); // last 2 digit
                    $MaxInc = 4;
                    $strlen_aa = strlen($aa);
                    $V_aa = $aa;
                    for ($j=0; $j < ($MaxInc-$strlen_aa); $j++) { 
                      $V_aa = '0'.$V_aa;
                    }
                    $inc = $CodeID.$P_ang.$V_aa;
                }
                else
                {
                  // $bb =(int)$bb
                  $bb = $bb + 1;
                  $inc = $bb;
                }

            $NPM = $inc;
            $ProgramID = 1; // program id pada db siak lama diset 1 adalah program kuliah reguler
            $LevelStudyID = $Q_Prodi[0]['EducationLevelID'];
            $ReligionID = $data[0]['ReligionID'];
            $NationalityID = $data[0]['NationalityID'];
            $ProvinceID = $data[0]['ID_province'];
            $CityID = $data[0]['ID_region'];
            $HighSchoolID = $data2[0]['SchoolID'];
            $SchoolName = $this->m_master->caribasedprimary('db_admission.school','ID',$HighSchoolID);

            $HighSchool = $SchoolName[0]['SchoolName'];
            $MajorsHighSchool = $this->m_master->caribasedprimary('db_admission.register_major_school','ID',$data[0]['ID_register_major_school']);
            $MajorsHighSchool = $MajorsHighSchool[0]['SchoolMajor'];
            $Name = $data2[0]['Name'];

            $Kelurahan = ' Kelurahan : '.$data[0]['District'];
            $DistrictID = $data[0]['ID_districts'];
            $DistrictID = $this->m_master->caribasedprimary('db_admission.district','DistrictID',$DistrictID);
            $DistrictID = ' Kecamatan : '.$DistrictID[0]['DistrictName'];
            $RegionID = $this->m_master->caribasedprimary('db_admission.region','RegionID',$data[0]['ID_region']);
            $RegionID = $RegionID[0]['RegionName'];
            $ID_province = $this->m_master->caribasedprimary('db_admission.province','ProvinceID',$data[0]['ID_province']);
            $ID_province = $ID_province[0]['ProvinceName'];

            $Address = $data[0]['Address'].$Kelurahan.$DistrictID.' '.$RegionID.' '.$ID_province;

            $Gender = $data[0]['Gender'];
            $PlaceOfBirth = $data[0]['PlaceBirth'];
            $DateOfBirth = $data[0]['DateBirth'];
            $Phone = $data[0]['PhoneNumber'];
            $HP = $data[0]['PhoneNumber'];
            $ClassOf  = $taDB[0]['Ta'];
            $Email = $data2[0]['Email'];
            $Jacket = $this->m_master->caribasedprimary('db_admission.register_jacket_size_m','ID',$data[0]['ID_register_jacket_size_m']);
            $Jacket = $Jacket[0]['JacketSize'];
            $AnakKe = '';
            $JumlahSaudara = '';
            $NationExamValue = '';
            $GraduationYear = $data[0]['YearGraduate'];
            $IjazahNumber = '';
            $Father = $data[0]['FatherName'];
            $Mother = $data[0]['MotherName'];
            $StatusFather = substr($data[0]['FatherStatus'], 0,1);
            $StatusMother = substr($data[0]['MotherStatus'], 0,1);
            $PhoneFather = $data[0]['FatherPhoneNumber'];
            $PhoneMother = $data[0]['MotherPhoneNumber'];
            $OccupationFather  = $this->m_master->caribasedprimary('db_admission.occupation','ocu_code',$data[0]['Father_ID_occupation']);
            $OccupationFather  = $OccupationFather[0]['ocu_name'];
            $OccupationMother = $this->m_master->caribasedprimary('db_admission.occupation','ocu_code',$data[0]['Mother_ID_occupation']);
            $OccupationMother = $OccupationMother[0]['ocu_name'];
            $EducationFather = '';
            $EducationMother = '';
            $AddressFather = $data[0]['FatherAddress'];
            $AddressMother = $data[0]['MotherAddress'];
            $EmailFather = '';
            $EmailMother = '';
            $StatusStudentID = 3;

            $temp = array(
                        'ProdiID' => $ProdiID,
                        'ProgramID' => $ProgramID,
                        'LevelStudyID' => $LevelStudyID,
                        'ReligionID' => $ReligionID,
                        'NationalityID' => $NationalityID,
                        'ProvinceID' => $ProvinceID,
                        'CityID' => $CityID,
                        'HighSchoolID' => $HighSchoolID,
                        'HighSchool' => $HighSchool,
                        'MajorsHighSchool' => $MajorsHighSchool,
                        'NPM' => $NPM,
                        'Name' => $Name,
                        'Address' => $Address,
                        'Gender' => $Gender,
                        'PlaceOfBirth' => $PlaceOfBirth,
                        'DateOfBirth' => $DateOfBirth,
                        'Phone' => $Phone,
                        'HP' => $HP,
                        'ClassOf' => $ClassOf,
                        'Email' => $Email,
                        'Jacket' => $Jacket,
                        'AnakKe' => $AnakKe,
                        'JumlahSaudara' => $JumlahSaudara,
                        'NationExamValue' => $NationExamValue,
                        'GraduationYear' => $GraduationYear,
                        'IjazahNumber' => $IjazahNumber,
                        'Father' => $Father,
                        'Mother' => $Mother,
                        'StatusFather' => $StatusFather,
                        'StatusMother' => $StatusMother,
                        'PhoneFather' => $PhoneFather,
                        'PhoneMother' => $PhoneMother,
                        'OccupationFather' => $OccupationFather,
                        'OccupationMother' => $OccupationMother,
                        'EducationFather' => $EducationFather,
                        'EducationMother' => $EducationMother,
                        'AddressFather' => $AddressFather,
                        'AddressMother' => $AddressMother,
                        'EmailFather' => $EmailFather,
                        'EmailMother' => $EmailMother,
                        'StatusStudentID' => $StatusStudentID,
                      );

            $this->db->insert($ta.'.students', $temp);

            // $arr[] = $temp;

            $plan_password = $NPM.''.'123456';
            $pas = md5($plan_password);
            $pass = sha1('jksdhf832746aiH{}{()&(&('.$pas.'HdfevgyDDw{}{}{;;766&&*');

            $pasword_old = $DateOfBirth;
            $d = explode('-', $pasword_old);
            $pasword_old = $d[2].$d[1].substr($d[0], 2,2);

            $temp2 = array(
                'NPM' => $NPM,
                'Password' => $pass,
                'Password_Old' => md5($pasword_old),
                'Year' => date('Y'),
                'EmailPU' => $NPM.'@podomorouniversity.ac.id',
                'StatusStudentID' => 3,
                'Status' => '-1',
            );

            $arr_insert_auth[] = $temp2;

            $dataSave = array(  
                'NPM' => $NPM,
                'FormulirCode' => $data2[0]['FormulirCode'],
                'DateTime' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('db_admission.to_be_mhs', $dataSave);


            // copy document
            if (!file_exists('./uploads/document/'.$NPM)) {
                mkdir('./uploads/document/'.$NPM, 0777, true);
                // copy("./document/index.html",'./document/'.$namaFolder.'/index.html');
                // copy("./document/index.php",'./document/'.$namaFolder.'/index.php');
            }

            $getDoc = $this->m_master->caribasedprimary('db_admission.register_document','ID_register_formulir',$arrInputID[$i]);
            for ($z=0; $z < count($getDoc); $z++) {
              if ($getDoc[$z]['Attachment'] != '' || !empty($getDoc[$z]['Attachment'])) {
                $explode = explode(',', $getDoc[$z]['Attachment']);
                if (count($explode) > 0) {
                  for ($ee=0; $ee < count($explode); $ee++) { 
                    copy($this->path_upload_regOnline.$Email.'/'.$explode[$ee], './uploads/document/'.$NPM.'/'.$explode[$ee]);
                  }
                }
                else
                {
                  copy($this->path_upload_regOnline.$Email.'/'.$getDoc[$z]['Attachment'], './uploads/document/'.$NPM.'/'.$getDoc[$z]['Attachment']);
                }

                 // copy($this->path_upload_regOnline.$Email.'/'.$getDoc[$z]['Attachment'], './uploads/document/'.$NPM.'/'.$getDoc[$z]['Attachment']);
              } 

              $dataSave = array(  
                  'NPM' => $NPM,
                  'ID_reg_doc_checklist' => $getDoc[$z]['ID_reg_doc_checklist'],
                  'Status' => $getDoc[$z]['Status'],
                  'Attachment' => $getDoc[$z]['Attachment'],
                  'Description' => $getDoc[$z]['Description'],
                  'VerificationBY' => $getDoc[$z]['VerificationBY'],
                  'VerificationAT' => $getDoc[$z]['VerificationAT'],
              );
              $this->db->insert('db_admission.doc_mhs', $dataSave);
            }

            //move payment
              $Semester = $input['Semester'];
              $Semester = explode('.', $Semester);
              $SemesterID = $Semester[0];

              // get payment
                 $getPaymentAdmisi = $this->m_master->caribasedprimary('db_finance.payment_admisi','ID_register_formulir',$arrInputID[$i]);
                 $PayFee = $this->m_master->caribasedprimary('db_finance.payment_pre','ID_register_formulir',$arrInputID[$i]);
                 $hitung = 0;
                 for ($x=0; $x < count($PayFee); $x++) { 
                   $InvoiceP = $PayFee[$x]['Invoice'];
                   if ($PayFee[$x]['Status'] == 1) {
                     $hitung = $hitung + $InvoiceP;
                   }
                   
                 }
                 for ($z=0; $z < count($getPaymentAdmisi); $z++) { 
                     $Invoice = $getPaymentAdmisi[$z]['Pay_tuition_fee'];

                     $dataSave = array(
                         'NPM' => $NPM,
                         'PTID' => $getPaymentAdmisi[$z]['PTID'],
                         'SemesterID' => $SemesterID,
                         'Invoice' => $Invoice,
                         'Discount' => $getPaymentAdmisi[$z]['Discount'],
                         'Status' => '1',
                     );
                     $this->db->insert('db_finance.payment', $dataSave);
                     $insert_id = $this->db->insert_id();

                     // cek lunas atau tidak
                     if ($hitung >= $Invoice) {
                       $dataSave = array(
                           'ID_payment' => $insert_id,
                           'Invoice' => $Invoice,
                           'BilingID' => 0,
                           'Status' => 1,
                       );
                       $this->db->insert('db_finance.payment_students', $dataSave);

                       $hitung = $hitung - $Invoice;
                     }
                     else
                     {
                        if ($hitung > 0) {
                         $dataSave = array(
                           'ID_payment' => $insert_id,
                           'Invoice' => $hitung,
                           'BilingID' => 0,
                           'Status' => 1,
                         );
                         $this->db->insert('db_finance.payment_students', $dataSave);

                         $Sisa =  $Invoice - $hitung;
                         $dataSave = array(
                           'ID_payment' => $insert_id,
                           'Invoice' => $Sisa,
                           'BilingID' => 0,
                           'Status' => 0,
                         );
                         $this->db->insert('db_finance.payment_students', $dataSave);
                         $hitung = 0;
                        }
                        else
                        {
                          $dataSave = array(
                            'ID_payment' => $insert_id,
                            'Invoice' => $Invoice,
                            'BilingID' => 0,
                            'Status' => 0,
                          );
                          $this->db->insert('db_finance.payment_students', $dataSave);
                        }
                     }

                     $text = 'Dear '.$Name.',<br><br>
                                 Congarulations, You were admitted to Podomoro University,<br>
                                 Your Nim is '.$NPM.'.<br><br>
                                 For Details, Please open your portal '.url_sign_out.' with :<br>
                                 Username : '.$NPM.'<br>
                                 Password : '.$pasword_old.'<br><br>
                             ';
                     $to = $Email;
                     $subject = "Podomoro University Registration";
                     $sendEmail = $this->m_sendemail->sendEmail($to,$subject,null,null,null,null,$text);

                  }  
            $aa++;
          }
          // print_r($arr);
          // die();

          // $this->db->insert_batch($ta.'.students', $arr);
          $this->db->insert_batch('db_academic.auth_students', $arr_insert_auth);

    }