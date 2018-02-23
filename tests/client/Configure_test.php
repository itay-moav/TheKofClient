<?php
use PHPUnit\Framework\TestCase;


/**
 * Testing the DryRequest generating functionality for
 * Surveys
 * 
 * @author Itay Moav
 */
class Configure_test extends TestCase {
	static public function setUpBeforeClass(){
		dbgn('======== CONFIGURATION');
	}

	/**
	 * Tests the get/set params
	 */
	public function testConfiguremissingAccessToekn(){
		$this->expectException(InvalidArgumentException::class);
		Talis\Extensions\TheKof\SurveyMonkey::init([],new TestHTTPClientWrapper);
	}
	
	public function testConfigureWithAccessToekn(){
		$Client=\Talis\Extensions\TheKof\SurveyMonkey::surveys();
		$this->assertInstanceOf(\Talis\Extensions\TheKof\Client_Surveys::class, $Client,'Client did not initiate with test configuration');
	}
}
