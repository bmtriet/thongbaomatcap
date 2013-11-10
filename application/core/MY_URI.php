<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_URI extends CI_URI {

	public function is($pattern)
	{
		if ( ! function_exists('str_is') )
		{
			$CI =& get_instance();
			$CI->load->helper('string');
		}

		foreach (func_get_args() as $pattern)
		{
			if (str_is($pattern, $this->uri_string()))
			{
				return true;
			}
		}

		return false;
	}

}

/* End of file MY_URI.php */
/* Location: ./application/core/MY_URI.php */