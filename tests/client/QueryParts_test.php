<?php use PHPUnit\Framework\TestCase;


/**
 * Testing the DryRequest generating functionality for
 * Surveys
 * 
 * @author Itay Moav
 */
class QueryParts_test extends TestCase {
	static public function setUpBeforeClass(){
		dbgn('======== Query PArts inside DryRequests');
	}

	public function testGetDryRequest(){
		dbgn('Testing SORT on a SURVEY');
		
		// TESTS
		
		//just query part
		$sort = new \TheKof\Client_QueryParts_SortBy('field','dir');
		$this->assertEquals(''.$sort,"sort_by=field&sort_order=dir",'Output of Sort query part is wrong');
		
		//dry request, no other params
		$ActualDryRequest = TheKof\SurveyMonkey::surveys()->get_dry(0,0,(new \TheKof\Client_QueryParts_SortBy('title','ASC')));
		$this->assertEquals('https://api.surveymonkey.net/v3/surveys?sort_by=title&sort_order=ASC',$ActualDryRequest->url());
		
		//dry request, with other params
		$ActualDryRequest = TheKof\SurveyMonkey::surveys()->get_dry(1,10,(new \TheKof\Client_QueryParts_SortBy('title','ASC')));
		$this->assertEquals('https://api.surveymonkey.net/v3/surveys?page=1&per_page=10&sort_by=title&sort_order=ASC',$ActualDryRequest->url());
		
		//just use of query
		$ActualDryRequest = TheKof\SurveyMonkey::surveys()->get_dry()->add_url_query_parts($sort);
		$this->assertEquals('https://api.surveymonkey.net/v3/surveys?sort_by=field&sort_order=dir',$ActualDryRequest->url());
		
		//with query in get_dry + query
		$ActualDryRequest = TheKof\SurveyMonkey::surveys()->query(new \TheKof\Client_QueryParts_SortBy('title','ASC'))->get_dry(1,10);
		$this->assertEquals('https://api.surveymonkey.net/v3/surveys?page=1&per_page=10&sort_by=title&sort_order=ASC',$ActualDryRequest->url());
	}
	
	public function testDryRequestAPI(){
	    $client = TheKof\SurveyMonkey::surveys()->query_freeform('title=baba')
	                                                             ->query_freeform('mom=washere')
	                                                             ->query(new \TheKof\Client_QueryParts_SortBy('title','ASC'));
	    $dry = $client->get_dry();
	    $this->assertEquals('https://api.surveymonkey.net/v3/surveys?title=baba&mom=washere&sort_by=title&sort_order=ASC',$dry->url());
	}
		
}
