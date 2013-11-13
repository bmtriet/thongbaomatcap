<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		return $this->template->build('home/index');
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */