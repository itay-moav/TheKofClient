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

\TheKof\SurveyMonkey::init(Env::$survey_monkey_config,$http_client_wrapper);//this two params are coming from the env.php file
$SurveyModel = \TheKof\SurveyMonkey::surveys(Env::$survey_id_to_query)->get_one();
$AllResponses = $SurveyModel->responses()->get();//u can use paging
foreach($AllResponses as $k => $response){ //Each response object corespond to an entire survey response by one user, it will have 1 to many pages/questions and answers in it
    \TheKof\SurveyMonkey::$L->debug("============================================ RESPONSE [{$k}]===============================================",
    $response->combine_responses_with_question($SurveyModel)->get_raw_data());//I pass the SurveyModel, as it holds the question texts.
}