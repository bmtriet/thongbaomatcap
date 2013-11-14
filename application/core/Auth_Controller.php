<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_Controller extends MY_Controller {

	/**
	 * Nhung URI co the bo qua kiem tra dang nhap
	 * Co the dung bieu thuc trong ham str_is
	 * 
	 * @var array
	 */
	protected $ignore_page = array();
	
	/**
	 * [__construct description]
	 * 
	 */
	public function __construct()
	{
		parent::__construct();

		$this->_permission();
	}

	/**
	 * [permission description]
	 * 
	 * @return [type] [description]
	 */
	protected function _permission()
	{
		if( ! $this->uri->is($this->ignore_page) )
		{
			if ( ! $this->ion_auth->logged_in() )
			{
				return redirect('login');
			}
			elseif ( ! $this->ion_auth->is_admin() )
			{
				return show_error('You must be an administrator to access this page.');
			}
		}
	}

}

/* End of file Auth_Controller.php */
/* Location: ./application/core/Auth_Controller.php */