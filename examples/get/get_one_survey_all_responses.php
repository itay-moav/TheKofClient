<?php
/**
 * Fetching the default response
 * currently is page = 1 and per_page = 50
 */
require_once '../env.php';
if(!is_numeric(Env::$survey_id_to_query)){
	echo "\nERROR!  You must put a numeric survey id in the env at Env::\$survey_monkey_config in env.php\n";
	exit;
}

\Talis\Extensions\TheKof\SurveyMonkey::init(Env::$survey_monkey_config,$http_client_wrapper);//this two params are coming from the env.php file
$responses = \Talis\Extensions\TheKof\SurveyMonkey::surveys(Env::$survey_id_to_query)->responses()->get();
foreach($responses as $response){
    var_dump($response->get_raw_data());
}