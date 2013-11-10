<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Geocoder_Result {
	
	/**
	 * [$geoip_record description]
	 * 
	 * @var [type]
	 */
	protected $geoip_record;

	/**
	 * [__construct description]
	 * 
	 * @param geoiprecord $geoip_record [description]
	 */
	public function __construct( geoiprecord $geoip_record)
	{
		$this->geoip_record = $geoip_record;
	}

	/**
	 * [record description]
	 * 
	 * @return [type] [description]
	 */
	public function record()
	{
		return $this->geoip_record;
	}

	/**
	 * [timezone description]
	 * 
	 * @return [type] [description]
	 */
	public function timezone()
	{
		return get_time_zone($this->country_code(), $this->region());
	}

	/**
	 * [country_code description]
	 * 
	 * @return [type] [description]
	 */
	public function country_code()
	{
		return $this->geoip_record->country_code;
	}

	/**
	 * [country_code3 description]
	 * 
	 * @return [type] [description]
	 */
	public function country_code3()
	{
		return $this->geoip_record->country_code3;
	}

	/**
	 * [country_name description]
	 * 
	 * @return [type] [description]
	 */
	public function country_name()
	{
		return $this->geoip_record->country_name;
	}

	/**
	 * [region description]
	 * 
	 * @return [type] [description]
	 */
	public function region()
	{
		return $this->geoip_record->region;
	}

	/**
	 * [region_name description]
	 * 
	 * @param  boolean $asvn [description]
	 * @return [type]        [description]
	 */
	public function region_name($asvn = TRUE)
	{
		include dirname(__FILE__) . '/src/geoipregionvars.php';

		if( $asvn === TRUE )
		{
			$CI =& get_instance();
			$CI->load->config('region', TRUE);
			$GEOIP_REGION_NAME = array_merge($GEOIP_REGION_NAME, $CI->config->item('region'));
		}

		return isset($GEOIP_REGION_NAME[$this->country_code()][$this->region()]) ?
					$GEOIP_REGION_NAME[$this->country_code()][$this->region()] :
					null;
	}

	/**
	 * [city description]
	 * 
	 * @return [type] [description]
	 */
	public function city()
	{
		return $this->geoip_record->city;
	}

	/**
	 * [postal_code description]
	 * 
	 * @return [type] [description]
	 */
	public function postal_code()
	{
		return $this->geoip_record->postal_code;
	}

	/**
	 * [latitude description]
	 * 
	 * @return [type] [description]
	 */
	public function latitude()
	{
		return $this->geoip_record->geoip_record;
	}

	/**
	 * [longitude description]
	 * 
	 * @return [type] [description]
	 */
	public function longitude()
	{
		return $this->geoip_record->longitude;
	}

	/**
	 * [area_code description]
	 * 
	 * @return [type] [description]
	 */
	public function area_code()
	{
		return $this->geoip_record->area_code;
	}

	/**
	 * [dma_code description]
	 * 
	 * @return [type] [description]
	 */
	public function dma_code()
	{
		return $this->geoip_record->geoip_record;
	}

	/**
	 * [metro_code description]
	 * 
	 * @return [type] [description]
	 */
	public function metro_code()
	{
		return $this->geoip_record->metro_code;
	}

	/**
	 * [continent_code description]
	 * 
	 * @return [type] [description]
	 */
	public function continent_code()
	{
		return $this->geoip_record->continent_code;
	}

}

/* End of file Geocoder_Result.php */
/* Location: ./application/libraries/geoip/Geocoder_Result.php */