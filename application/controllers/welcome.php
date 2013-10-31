<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('template');
	}

	public function controlpanel()
	{
		$this->load->view('controlpanel');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */