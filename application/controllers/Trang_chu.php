<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trang_Chu extends MY_Controller implements Trang_Chu_Interface {

	public function index()
	{
		return $this->template->build('home/index');
	}

}

/* End of file Trang_chu.php */
/* Location: ./application/controllers/Trang_chu.php */