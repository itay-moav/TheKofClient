<?php namespace Talis\Extensions\TheKof;
/**
 * @author Itay Moav
 * @Date Nov 17 - 2017
 */
class HTTPClientWrapper_ZendFW2 extends HTTPClientWrapper_a{
	
	/**
	 * I have it here for sake of documentation
	 * 
	 * @var \Zend\Http\Client
	 */
	protected $concrete_http_client = null;
	
	/**
	 * This is where the actual translation from DryRequest info to the actual client
	 * is happening.
	 *
	 * @param Util_DryRequest $DryRequest
	 * @return Util_RawResponse
	 */
	public function execute_dry_request(Util_DryRequest $DryRequest):Util_RawResponse{
 dbgn("\n==================================================\nDOing " . $DryRequest->method() . ': ' . $DryRequest->url());
		$this->concrete_http_client->setMethod($DryRequest->method());
		$this->concrete_http_client->setUri($DryRequest->url());
		$this->concrete_http_client->setHeaders($DryRequest->headers());
		
		switch($DryRequest->method()){
			case self::METHOD_GET:
				break;
				
			default:
				$body_encoded = json_encode($DryRequest->body());
				$this->concrete_http_client->setRawBody($body_encoded);
				break;
		}
		
		$res = $this->concrete_http_client->send();
		$Response = new Util_RawResponse;
		$Response->http_code 			= $res->getStatusCode();
		$Response->http_code_message	= $res->getReasonPhrase();
		$Response->headers				= $res->getHeaders()->toArray();
		$Response->body					= json_decode($res->getBody());
		return $Response;
	}
}