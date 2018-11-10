public function checkDB($Database)
    {
        $sql = "show databases like '%".$Database."%'";
        $query=$this->db->query($sql, array())->result_array();
        if (count($query) > 0) {
            // existing
            return false;
        }
        else
        {
            return true;
        }
    }

    public function createDBYearAcademicNew($db_new){
        $this->load->dbforge();

        if ($this->dbforge->create_database($db_new)) {

            // Student
            $this->db->query('CREATE TABLE '.$db_new.'.students (
                              `ID` int(11) NOT NULL AUTO_INCREMENT,
                              `ProdiID` int(11) DEFAULT NULL,
                              `ProgramID` int(11) DEFAULT NULL,
                              `LevelStudyID` int(11) DEFAULT NULL,
                              `ReligionID` int(11) DEFAULT NULL,
                              `NationalityID` int(11) DEFAULT NULL,
                              `ProvinceID` int(11) DEFAULT NULL,
                              `CityID` int(11) DEFAULT NULL,
                              `HighSchoolID` int(11) DEFAULT NULL,
                              `HighSchool` text,
                              `MajorsHighSchool` varchar(45) DEFAULT NULL,
                              `NPM` varchar(20) DEFAULT NULL,
                              `Name` varchar(200) DEFAULT NULL,
                              `Address` text,
                              `Photo` text,
                              `Gender` varchar(2) DEFAULT NULL,
                              `PlaceOfBirth` varchar(100) DEFAULT NULL,
                              `DateOfBirth` date DEFAULT NULL,
                              `Phone` varchar(10) DEFAULT NULL,
                              `HP` varchar(15) DEFAULT NULL,
                              `ClassOf` varchar(30) DEFAULT NULL,
                              `Email` varchar(100) DEFAULT NULL,
                              `Jacket` varchar(2) DEFAULT NULL,
                              `AnakKe` int(11) DEFAULT NULL,
                              `JumlahSaudara` int(11) DEFAULT NULL,
                              `NationExamValue` decimal(10,0) DEFAULT NULL,
                              `GraduationYear` int(11) DEFAULT NULL,
                              `IjazahNumber` varchar(50) DEFAULT NULL,
                              `Father` varchar(45) DEFAULT NULL,
                              `Mother` varchar(45) DEFAULT NULL,
                              `StatusFather` varchar(2) DEFAULT NULL,
                              `StatusMother` varchar(2) DEFAULT NULL,
                              `PhoneFather` varchar(15) DEFAULT NULL,
                              `PhoneMother` varchar(15) DEFAULT NULL,
                              `OccupationFather` text,
                              `OccupationMother` text,
                              `EducationFather` varchar(45) DEFAULT NULL,
                              `EducationMother` varchar(45) DEFAULT NULL,
                              `AddressFather` text,
                              `AddressMother` text,
                              `EmailFather` varchar(100) DEFAULT NULL,
                              `EmailMother` varchar(100) DEFAULT NULL,
                              `StatusStudentID` int(11) DEFAULT NULL,
                              PRIMARY KEY (`ID`),
                              UNIQUE KEY `NPM` (`NPM`)
                            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1');

            // study_planning
            $this->db->query('CREATE TABLE '.$db_new.'.study_planning (
                              `ID` int(11) NOT NULL AUTO_INCREMENT,
                              `SemesterID` int(11) DEFAULT NULL,
                              `MhswID` int(11) DEFAULT NULL,
                              `NPM` varchar(30) NOT NULL,
                              `ScheduleID` int(11) NOT NULL,
                              `TypeSchedule` enum("Br","Ul") DEFAULT NULL,
                              `CDID` int(11) DEFAULT NULL,
                              `MKID` int(11) DEFAULT NULL,
                              `Credit` int(11) DEFAULT NULL,
                              `Evaluasi1` float DEFAULT NULL,
                              `Evaluasi2` float DEFAULT NULL,
                              `Evaluasi3` float DEFAULT NULL,
                              `Evaluasi4` float DEFAULT NULL,
                              `Evaluasi5` float DEFAULT NULL,
                              `UTS` float DEFAULT NULL,
                              `UAS` float DEFAULT NULL,
                              `Score` float DEFAULT NULL,
                              `Grade` varchar(3) DEFAULT NULL,
                              `GradeValue` float DEFAULT NULL,
                              `Approval` enum("0","1") DEFAULT NULL,
                              `StatusSystem` enum("1","0") DEFAULT NULL COMMENT "0 = Siak Lama , 1 = Baru",
                              `Glue` varchar(45) DEFAULT NULL,
                              `Status` enum("0","1") DEFAULT NULL,
                              PRIMARY KEY (`ID`)
                            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1');

        }
    }