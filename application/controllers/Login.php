<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public $data = array('pesan' =>'');
	
	public function __construct()
   	{
        parent::__construct();
        //$this->load->model('user');
        $this->load->model('login_model','login',TRUE);
        // Your own constructor code
   	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// echo md5(sha1('itjstgoogle2018'));
		$this->load->helper('captcha');
		$this->data['messages_captcha'] = '';
	 	// status user  login ==  benar, pindah ke halaman absen
	 	 if ($this->session->userdata('login')== TRUE) {
	 	 	# code...
	 	 	redirect('dashboard');
	 	 }
	 	 // status login salah, tampilkan form login
	 	 else
	 	{
	 	 	//check captcha
	 	 	if (($this->session->userdata('wrong') > 5) && ($this->session->userdata('wrong') != '')) {
	 	 		$captcha = trim($this->input->post('captcha'));
	 	 		if ($this->session->userdata('captcha') == $captcha) {
	 	 			//check validasi
	 	 			if ($this->login->validasi())
	 	 			{
	 	 				//cek didatabase sukses
	 	 				if ($this->login->cek_user())
	 	 				{
	 	 					redirect('dashboard');
	 	 					$this->session->unset_userdata('wrong');
	 	 					$this->session->unset_userdata('captcha');
	 	 				}
	 	 				else
	 	 				{
	 	 					$abc=array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u"
			 	 			,"v","w","x","y","z");
				 	 		$word = '';
				 	 		$n = 0;
				 	 		while ($n <= 10) {
				 	 			$word .= $abc[mt_rand(0,35)];
				 	 			$n++;
				 	 		}

				 	 		$captcha = array(
				 	 			'word'=> substr($word,0,5),
				 	 			'img_path'=>'./xyzp/',
				 	 			'img_url'=>base_url().'xyzp/',
				 	 			'font_path'=>'./xyzp/fonts/texb.ttf',
				 	 			'img_width'=>'320',
				 	 			'img_height'=>'70',
				 	 			'expiration'=>'60'
		 	 				);

				 	 		$img=create_captcha($captcha);
				 	 		$this->session->set_userdata('captcha', $captcha['word']);
				 	 		$this->data['image'] = $img['image'];
				 	 		$this->data['pesan'] = 'Username atau Password Salah.';
				 	 		$this->session->set_userdata('captcha', $captcha['word']);
				 	 		$wrong=$this->session->userdata('wrong');
			 	 			$wrong++;
			 	 			$this->session->set_userdata('wrong', $wrong);
				 	 		$this->load->view('login/login',$this->data);
	 	 				}
	 	 			}
	 	 			else
	 	 			{
	 	 					$abc=array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u"
			 	 			,"v","w","x","y","z");
				 	 		$word = '';
				 	 		$n = 0;
				 	 		while ($n <= 10) {
				 	 			$word .= $abc[mt_rand(0,35)];
				 	 			$n++;
				 	 		}

				 	 		$captcha = array(
				 	 			'word'=> substr($word,0,5),
				 	 			'img_path'=>'./xyzp/',
				 	 			'img_url'=>base_url().'xyzp/',
				 	 			'font_path'=>'./xyzp/fonts/texb.ttf',
				 	 			'img_width'=>'320',
				 	 			'img_height'=>'70',
				 	 			'expiration'=>'60'
			 	 			);

				 	 		$img=create_captcha($captcha);
				 	 		$this->session->set_userdata('captcha', $captcha['word']);
				 	 		$this->data['image'] = $img['image'];
				 	 		$this->data['pesan'] = 'Username atau Password Salah.';
				 	 		$this->session->set_userdata('captcha', $captcha['word']);
				 	 		$wrong=$this->session->userdata('wrong');
			 	 			$wrong++;
			 	 			$this->session->set_userdata('wrong', $wrong);
				 	 		$this->load->view('login/login',$this->data);
	 	 			} 

	 	 		}
	 	 		else
	 	 		{
	 	 					$abc=array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u"
			 	 			,"v","w","x","y","z");
				 	 		$word = '';
				 	 		$n = 0;
				 	 		while ($n <= 10) {
				 	 			$word .= $abc[mt_rand(0,35)];
				 	 			$n++;
				 	 		}

				 	 		$captcha = array(
				 	 			'word'=> substr($word,0,5),
				 	 			'img_path'=>'./xyzp/',
				 	 			'img_url'=>base_url().'xyzp/',
				 	 			'font_path'=>'./xyzp/fonts/texb.ttf',
				 	 			'img_width'=>'320',
				 	 			'img_height'=>'70',
				 	 			'expiration'=>'60'
			 	 			);

				 	 		$img=create_captcha($captcha);
				 	 		$this->session->set_userdata('captcha', $captcha['word']);
				 	 		$this->data['image'] = $img['image'];
				 	 		$this->data['pesan'] = 'Username atau Password Salah.';
				 	 		$this->data['messages_captcha'] = 'Captcha is wrong';
				 	 		$this->session->set_userdata('captcha', $captcha['word']);
				 	 		$wrong=$this->session->userdata('wrong');
			 	 			$wrong++;
			 	 			$this->session->set_userdata('wrong', $wrong);
				 	 		$this->load->view('login/login',$this->data);
	 	 		}
	 	 	}
	 	 	else
	 	 	{

			 	 	//validasi sukses
			 	 	if ($this->login->validasi()) 
			 	 	{
			 	 		# code...
			 	 		//cek didatabase sukses
			 	 		if ($this->login->cek_user()) 
			 	 		{
			 	 			redirect('dashboard');
			 	 			
			 	 		}
			 	 		// cek database gagal
			 	 		elseif($this->session->userdata('wrong') == '')
			 	 		{
			 	 			$this->data['pesan'] = 'Username atau Password Salah.';
			 	 			$this->load->view('login/login',$this->data);
			 	 			$this->session->set_userdata('wrong', '1');
			 	 		}
			 	 		elseif(($this->session->userdata('wrong') <= 1))
			 	 		{
			 	 			$this->data['pesan'] = 'Username atau Password Salah.';
			 	 			$this->load->view('login/login',$this->data);
			 	 			$wrong=$this->session->userdata('wrong');
			 	 			$wrong++;
			 	 			$this->session->set_userdata('wrong', $wrong);
			 	 		}
			 	 		else
			 	 		{
		 					$abc=array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u"
			 	 			,"v","w","x","y","z");
				 	 		$word = '';
				 	 		$n = 0;
				 	 		while ($n <= 10) {
				 	 			$word .= $abc[mt_rand(0,35)];
				 	 			$n++;
				 	 		}

				 	 		$captcha = array(
				 	 			'word'=> substr($word,0,5),
				 	 			'img_path'=>'./xyzp/',
				 	 			'img_url'=>base_url().'xyzp/',
				 	 			'font_path'=>'./xyzp/fonts/texb.ttf',
				 	 			'img_width'=>'320',
				 	 			'img_height'=>'70',
				 	 			'expiration'=>'60'
			 	 			);

				 	 		$img=create_captcha($captcha);
				 	 		$this->data['image'] = $img['image'];
				 	 		$this->data['pesan'] = 'Username atau Password Salah.';
				 	 		$this->session->set_userdata('captcha', $captcha['word']);
				 	 		$wrong=$this->session->userdata('wrong');
			 	 			$wrong++;
			 	 			$this->session->set_userdata('wrong', $wrong);
				 	 		$this->load->view('login/login',$this->data);

			 	 		}
			 	 	}
			 	 	//validasi gagal
			 	 	else
			 	 	{
			 	 		$this->load->view('login/login',$this->data);
			 	 	}

	 	 	}
	 	}
	}

	public function logout()
	{
	  	$this->login->logout();
	  	redirect ('login');
	}
}
