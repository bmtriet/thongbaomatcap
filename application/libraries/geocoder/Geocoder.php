<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/src/geoipcity.inc';
require_once dirname(__FILE__) . '/src/timezone.php';
require_once dirname(__FILE__) . '/Geocoder_Result.php';

class Geocoder {

	/**
	 * [$dat_file description]
	 * 
	 * @var [type]
	 */
	protected $dat_file;

	/**
	 * [$open_flag description]
	 * 
	 * @var [type]
	 */
	protected $open_flag;

	/**
	 * [$CI description]
	 * 
	 * @var [type]
	 */
	protected $CI;

	/**
	 * [__construct description]
	 * 
	 * @param [type] $dat_file  [description]
	 * @param [type] $open_flag [description]
	 */
	public function __construct($dat_file = NULL, $open_flag = NULL)
	{
		$this->CI =& get_instance();
		$this->CI->load->config('geocoder', TRUE);

		$dat_file = $this->CI->config->item('dat_file', 'geocoder');
		$open_flag = $this->CI->config->item('open_flag', 'geocoder');

		$this->initialize($dat_file, $open_flag);
	}

	/**
	 * [initialize description]
	 * 
	 * @param  [type] $dat_file  [description]
	 * @param  [type] $open_flag [description]
	 * @return [type]            [description]
	 */
	public function initialize($dat_file, $open_flag = NULL)
	{
		$this->dat_file = is_file($dat_file) ? $dat_file : dirname(__FILE__) . '/data/GeoLiteCity.dat';
		$this->open_flag = null === $open_flag ? GEOIP_STANDARD : $open_flag;
	}

	/**
	 * [lookup description]
	 * 
	 * @param  [type] $ip_address [description]
	 * @return [type]             [description]
	 */
	public function lookup($ip_address = NULL)
	{
		$ip_address = is_null($ip_address) ? $this->CI->input->ip_address() : $ip_address;

		if (false === filter_var($ip_address, FILTER_VALIDATE_IP))
		{
			log_message('error', 'IP-Address Invalid!');
			return false;
		}

		$geoip = geoip_open($this->dat_file, $this->open_flag);
		$geoip_record = GeoIP_record_by_addr($geoip, $ip_address);

		geoip_close($geoip);

		if (false === $geoip_record instanceof geoiprecord)
		{
			log_message('error', 'GeoIP error!');
			return false;
		}

		return new Geocoder_Result($geoip_record);
	}

}

/* End of file Geocoder.php */
/* Location: ./application/libraries/geoip/Geocoder.php */