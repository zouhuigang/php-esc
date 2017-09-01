<?php

namespace package\phpesc;

class LibBase {
	private $SERVER = 'http://139.196.48.36:9200/';
	private $HEADERS = array('Accept: application/json', 'Content-Type: application/json');
	private $URL_PARAMETERS = array('index','type','id');
	private $ERROR_MENSSAGE = array('error'=> TRUE,'status'=> 'failed');
	
	public  $RESPONSE = array();
	public  $JSON;
	public function exec_curl($method)
	{
		if($method)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->SERVER.$this->PARAMETERS);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->HEADERS);
			switch ($method)
			{
				case "GET":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
				break;
				case "POST":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $this->JSON);                   
				break; 
				case "PUT":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $this->JSON);
				break;
				case "DELETE":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
				break;                                     
				default:
				$this->ERROR_MENSSAGE['message'][] = 'Invalid http request method';
				$this->RESPONSE = $this->ERROR_MENSSAGE; 
				break;
			}
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
			curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			if(isset($this->ERROR_MENSSAGE['message']))
			{
				$this->RESPONSE = json_encode($this->ERROR_MENSSAGE);
			}
			else
			{
				$this->RESPONSE = curl_exec($ch);
				if(!$this->RESPONSE)
				{
					$this->RESPONSE = json_encode(array('Error'=>'Service Unavailable','status'=>'failed'));
				}
			}
			
		}
		else
		{
			$this->ERROR_MENSSAGE['message'][] = 'Unsupported request method';
		 
		}
	}


	public function call($path, $method = 'GET', $data = null)
    {
      
		$url = $this->SERVER. $path;
        $headers = array('Accept: application/json', 'Content-Type: application/json', );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        switch($method) {
            case 'GET' :
                break;
            case 'POST' :
				curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //raw方式
                break;
            case 'PUT' :
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            case 'DELETE' :
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }
        $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return json_decode($response, true);
    }


	public function validate_json($json)
	{
		if($json)
		{
			$this->JSON = $json;
		}
		else
		{
			$this->ERROR_MENSSAGE['message'][] = 'Create() method requires a json object as a parameter';
		 	
		}
	}
	public function url_build($fields)
	{
		$parameters_request = FALSE;
		if($fields)
		{
			for ($i=0; $i < count($fields); $i++)
			{ 
				if(isset($fields[$this->URL_PARAMETERS[$i]]))
				{
					$parameters_request .= $fields[$this->URL_PARAMETERS[$i]].'/';
				}
			}
			if($parameters_request)
			{
				$this->PARAMETERS = $parameters_request;
			}
			else
			{
				$this->ERROR_MENSSAGE['message'][] = 'Failed to mount request url';
			
			}
		}
		else
		{
			$this->ERROR_MENSSAGE['message'][] = 'Failed in url build, not have parameters';
		
		}
	}
	public function _validate_parameters($fields)
	{
		
		if($fields && is_array($fields) && count($fields) > 0)
		{
			$keys = array_keys($fields);
			for ($i=0; $i < count($keys); $i++)
			{ 
				if(isset($keys[$i]) && !in_array($keys[$i], $this->URL_PARAMETERS))
				{
					$this->ERROR_MENSSAGE['message'][] = 'invalid '.$keys[$i].' field for search';
				
				}
			}   
		}
		else
		{ 
			$this->ERROR_MENSSAGE['message'][] = "An array parameter with the 'index' key is expected"; 
		
		}
	}



}
