<?php
/**
 * Show console output.
 *
 * @param  string  $text
 *
 * @return void;
 */
function dbgn($text)
{
	fwrite(STDERR,"\n==== {$text}\n");
}

/**
 * Emulates env values
 */
class Env{
	static public $survey_monkey_config = ['access_token' => 'this_is_a_test_access_code_you_should_see_it_in_mock_requests'];
}

require_once '../bundle/thekofclient.php';

/**
 * @author Itay Moav
 * @Date Dec 8 - 2017
 */
class TestHTTPClientWrapper extends \TheKof\ThirdPartyWrappers_HTTPClient_a{
	
	public function __construct(){
		$this->concrete_http_client = null;
	}
	
	/**
	 * This is where the actual translation from DryRequest info to the actual client
	 * is happening.
	 *
	 * @param \TheKof\Util_DryRequest $DryRequest
	 * @return \TheKof\Util_RawResponse
	 */
	protected function execute_dry_request_internal(\TheKof\Util_DryRequest $DryRequest):\TheKof\Util_RawResponse{
		echo "\n==================================================\nDOing " . $DryRequest->url() . "\n\n\n\n";
		$Response = new \TheKof\Util_RawResponse;
		$Response->http_code 			= 200;
		$Response->http_code_message	= 'baba was here - all is good';
		$Response->headers				= [];
		$Response->body					= new stdClass;
		return $Response;
	}
}

TheKof\SurveyMonkey::init(Env::$survey_monkey_config,new TestHTTPClientWrapper);
