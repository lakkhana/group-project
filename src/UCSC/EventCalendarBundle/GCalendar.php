<?php 
namespace UCSC\EventCalendarBundle;

use \Zend_Gdata_Calendar;
use \Zend_Gdata_ClientLogin;
use \Zend_Http_Client;

class GCalendar
{
	protected $gcal;
	
	public function __construct($user,$pass)
    {
    	/*
    	$config = array(
    			'adapter'    => 'Zend_Http_Client_Adapter_Proxy',
    			'proxy_host' => '192.248.16.90',
    			'proxy_port' => '3128'
    	);
    	
        
        $clientp = new Zend_Http_Client('https://www.gmail.com', $config);
        */
    	$gcal = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
        $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $gcal);
        $this->gcal = new Zend_Gdata_Calendar($client);
    }
    
    public function getCalendar()
    {
    	return $this->gcal;
    }
}