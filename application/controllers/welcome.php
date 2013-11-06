<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data["contenido"] = $this->load->view('template',null,true);

		$this->load->view('base',$data);
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */