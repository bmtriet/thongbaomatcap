<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/**
	 * Cac model duoc tu dong load.
	 * 
	 * @var [type]
	 */
	protected $models = array();

	/**
	 * Cac thu vien duoc tu dong load.
	 * 
	 * @var array
	 */
	protected $libraries = array();
	
	/**
	 * Cac helpers duoc tu dong load.
	 * 
	 * @var array
	 */
	protected $helpers = array();
	
	/**
	 * [$layout description]
	 * 
	 * @var [type]
	 */
	protected $layout;

	/**
	 * [__construct description]
	 * 
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->_initialize();
	}

	/**
	 * [_autoload description]
	 * 
	 * @return [type] [description]
	 */
	protected function _initialize()
	{
		// Thiet lap layout mac dinh
		if( ! is_null($this->layout) )
		{
			$this->template->set_layout($this->layout);
		}

		//--------------------------------------------------------------------
		// Auto-load
		//--------------------------------------------------------------------

		$data = array(
			'models'    => 'model',
			'libraries' => 'library',
			'helpers'   => 'helper'
		);
		
		foreach ($data as $var => $load)
		{
			if ( is_array($this->{$var}) && ! empty($this->{$var}) )
			{
				foreach ($this->{$var} as $data)
				{
					$this->load->{$load}($data);
				}
			}
		}

		//--------------------------------------------------------------------
		// Development Environment Setup
		//--------------------------------------------------------------------

		if (ENVIRONMENT == 'development')
		{
			$this->output->enable_profiler(TRUE);
		}

	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */