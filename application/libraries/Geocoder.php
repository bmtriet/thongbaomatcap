<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/geoip/src/geoipcity.inc';
require_once APPPATH . 'third_party/geoip/src/timezone.php';
require_once APPPATH . 'third_party/geoip/Geocoder_Result.php';

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
	public function __construct( array $config = array() )
	{
		$this->initialize($config['dat_file'], $config['open_flag']);
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
		$this->dat_file = is_file($dat_file) ? $dat_file : APPPATH . 'third_party/geoip/data/GeoLiteCity.dat';
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
		$ip_address = is_null($ip_address) ? $this->CI->input->ip_address() : trim($ip_address);

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