<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Function_Model extends CI_Model {
	private $data = array();
    private $error_validation_myself = array(); // 1 is True, 0 is false
    private $msgerror_myself = array();
    public function __construct()
    {
        parent::__construct();
    }


}
