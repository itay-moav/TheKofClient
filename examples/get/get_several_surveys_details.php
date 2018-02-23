<?php
/**
 * Fetching the survey details object which is pages and nested in it are questions in each page
 */
require_once '../env.php';
if(!is_numeric(Env::$survey_id_to_query)){
	echo "\nERROR!  You must put a numeric survey id in the env at Env::\$survey_monkey_config in env.php\n";
	exit;
}

\Talis\Extensions\TheKof\SurveyMonkey::init(Env::$survey_monkey_config,$http_client_wrapper);//this two params are coming from the env.php file
$all_surveys = \Talis\Extensions\TheKof\SurveyMonkey::surveys()->get(1,3);
foreach ($all_surveys as $survey){
    /* @var $survey Model_Survey */
    var_dump($survey->details());
}
