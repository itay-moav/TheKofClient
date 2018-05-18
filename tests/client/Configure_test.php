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
		TheKof\SurveyMonkey::init([],new TestHTTPClientWrapper);
	}
	
	public function testConfigureWithAccessToekn(){
		$Client=\TheKof\SurveyMonkey::surveys();
		$this->assertInstanceOf(\TheKof\Client_Surveys::class, $Client,'Client did not initiate with test configuration');
	}
}
