<?php
/**
 * Fetching the default response
 * currently is page = 1 and per_page = 50
 */
require_once '../env.php';
\TheKof\SurveyMonkey::init(Env::$survey_monkey_config,$http_client_wrapper);//this two params are coming from the env.php file
$all_surveys = \TheKof\SurveyMonkey::surveys()->get();
foreach ($all_surveys as $survey){
	/* @var $survey Model_Survey */
	var_dump($survey->get_raw_data());
}
