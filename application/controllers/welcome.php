<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata("is_logged") == true){
//			echo $this->session->userdata("is_logged")."<--";
		} else {
			$this->session->set_userdata("is_logged",false);			
		}
	}

	public function index()
	{
		$data["main"] = true;
		$data["contenido"] = $this->load->view('bootstrap',$data,true);
		$this->load->view('template',$data);
	}

	public function tabs()
	{
		$data["contenido"] = $this->load->view('tabs',null,true);

		$this->load->view('base',$data);
	}

	public function controlpanel()
	{
		$this->load->view('controlpanel');
	}

	public function bootstrap()
	{
		$this->load->view('bootstrap');
	}
}