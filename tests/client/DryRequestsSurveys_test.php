<?php use PHPUnit\Framework\TestCase;


/**
 * Testing the DryRequest generating functionality for
 * Surveys
 * 
 * @author Itay Moav
 */
class DryRequestsSurveys_test extends TestCase {
	static public function setUpBeforeClass(){
		dbgn('======== DRY REQUESTS FOR SURVEYS');
	}

	public function testGetDryRequest(){
		dbgn('Testing GET');
		// init
		$access_token = Env::$survey_monkey_config['access_token'];
		$fake_survey_id = 1234;
		$headers = [
				'Authorization' => "bearer {$access_token}",
				'Content-type'  => 'application/json'
		];
		
		// TESTS 
		
		//1. default request
		$expected_url = "https://api.surveymonkey.net/v3/surveys/{$fake_survey_id}";
		$ExpectedDryRequest = new \Talis\Extensions\TheKof\Util_DryRequest(Env::$survey_monkey_config['access_token']);
		$ExpectedDryRequest->url($expected_url);
		$ExpectedDryRequest->method(\Talis\Extensions\TheKof\ThirdPartyWrappers_HTTPClient_a::METHOD_GET);
		
		$ActualDryRequest = Talis\Extensions\TheKof\SurveyMonkey::surveys($fake_survey_id)->get_dry();
		$this->assertInstanceOf(\Talis\Extensions\TheKof\Util_DryRequest::class, $ActualDryRequest,'Dry request must return a \Talis\Extensions\TheKof\DryRequest object');
		$this->assertEquals($ExpectedDryRequest,$ActualDryRequest,'response structure is not same');
		
		$this->assertEquals($expected_url, $ActualDryRequest->url(),'url does not match');
		$this->assertEquals('GET', $ActualDryRequest->method(),'METHOD does not match');
		$this->assertEquals($headers, $ActualDryRequest->headers(),'headers do not match');
		
		//2. page one, default size
		$expected_url = "https://api.surveymonkey.net/v3/surveys/{$fake_survey_id}?page=1";
		$ExpectedDryRequest = new \Talis\Extensions\TheKof\Util_DryRequest(Env::$survey_monkey_config['access_token']);
		$ExpectedDryRequest->url($expected_url);
		$ExpectedDryRequest->method(\Talis\Extensions\TheKof\ThirdPartyWrappers_HTTPClient_a::METHOD_GET);
		
		$ActualDryRequest = Talis\Extensions\TheKof\SurveyMonkey::surveys($fake_survey_id)->get_dry(1);
		$this->assertEquals($ExpectedDryRequest,$ActualDryRequest,'(page 1) response structure is not same');

		$this->assertEquals($expected_url, $ActualDryRequest->url(),'url does not match');
		$this->assertEquals('GET', $ActualDryRequest->method(),'METHOD does not match');
		$this->assertEquals($headers, $ActualDryRequest->headers(),'headers do not match');
		
		
		//3. page 2 size 10
		$expected_url = "https://api.surveymonkey.net/v3/surveys/{$fake_survey_id}?page=2&per_page=10";
		$ExpectedDryRequest = new \Talis\Extensions\TheKof\Util_DryRequest(Env::$survey_monkey_config['access_token']);
		$ExpectedDryRequest->url($expected_url);
		$ExpectedDryRequest->method(\Talis\Extensions\TheKof\ThirdPartyWrappers_HTTPClient_a::METHOD_GET);
		
		$ActualDryRequest = Talis\Extensions\TheKof\SurveyMonkey::surveys($fake_survey_id)->get_dry(2,10);
		$this->assertEquals($ExpectedDryRequest,$ActualDryRequest,'(page 2,10) response structure is not same');
		
		$this->assertEquals($expected_url, $ActualDryRequest->url(),'url does not match');
		$this->assertEquals('GET', $ActualDryRequest->method(),'METHOD does not match');
		$this->assertEquals($headers, $ActualDryRequest->headers(),'headers do not match');
	}
	
	public function testPatchDryRequest(){
	    dbgn('Testing PATCH');
	    // init
	    $access_token = Env::$survey_monkey_config['access_token'];
	    $fake_survey_id = 1234;
	    $headers = [
	        'Authorization' => "bearer {$access_token}",
	        'Content-type'  => 'application/json'
	    ];
	    
	    /**
	     * Testing for switching/adding custom variables
	     * @var stdClass $raw_data
	     */
	    $patch_data = new stdClass;
	    $patch_data->custom_variables = new stdClass;
	    $patch_data->custom_variables->test1 = 'test1lbl';
	    $patch_data->custom_variables->test2 = 'test2lbl';
	    
	    
	    // TESTS
	    
	    //patch new custome variables - see request is legit
	    $expected_url = "https://api.surveymonkey.net/v3/surveys/{$fake_survey_id}";
	    $ExpectedDryRequest = new \Talis\Extensions\TheKof\Util_DryRequest(Env::$survey_monkey_config['access_token']);
	    $ExpectedDryRequest->url($expected_url);
	    $ExpectedDryRequest->method(\Talis\Extensions\TheKof\ThirdPartyWrappers_HTTPClient_a::METHOD_PATCH);
	    $ExpectedDryRequest->body($patch_data);
	    
	    $ActualDryRequest = Talis\Extensions\TheKof\SurveyMonkey::surveys($fake_survey_id)->patch_dry($patch_data);
	    
	    $this->assertInstanceOf(\Talis\Extensions\TheKof\Util_DryRequest::class, $ActualDryRequest,'patch_dry method must return a \Talis\Extensions\TheKof\DryRequest object');
	    $this->assertEquals($ExpectedDryRequest,    $ActualDryRequest,            'response structure is not same');
	    $this->assertEquals($expected_url,          $ActualDryRequest->url(),     'url does not match');
	    $this->assertEquals('PATCH',                $ActualDryRequest->method(),  'METHOD does not match');
	    $this->assertEquals($headers,               $ActualDryRequest->headers(), 'headers do not match');
	    $this->assertEquals($patch_data,            $ActualDryRequest->body(),    'Body does not match');
	    
	}
}
