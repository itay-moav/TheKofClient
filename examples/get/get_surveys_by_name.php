<?php
/**
 * Fetch all surveys with the input name (input name you want to try with must be entered in the ENV file).
 * Fetching by name will always return a collection as u might have several surveys with same name
 * NOTICE! You can put a partial name and all matching surveys will be brought back
 */
require_once '../env.php';

if(!is_string(Env::$survey_name_to_query)){
	echo "\nERROR!  You must put a survey name in the env at Env::\$survey_monkey_config in env.php\n";
	exit;
}

$Client = \Talis\Services\TheKof\SurveyMonkeyClient::init(Env::$survey_monkey_config,$http_client_wrapper);//this two params are coming from the env.php file
$query='title=' . Env::$survey_name_to_query;
$surveys = $Client->surveys()->query($query)->get(1,2);
foreach ($surveys as $survey){
	var_dump($survey->get_raw_data());
}