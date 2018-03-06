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

\Talis\Extensions\TheKof\SurveyMonkey::init(Env::$survey_monkey_config,$http_client_wrapper);//this two params are coming from the env.php file
$query='title=test';// . Env::$survey_name_to_query;
$surveys = \Talis\Extensions\TheKof\SurveyMonkey::surveys()->query_freeform($query)->get(1,2);
foreach ($surveys as $survey){
	echo "\n\n================================================\n";
	var_dump($survey->get_raw_data());
	
	//BELOW I SHOW HOW THE DRILL DOWN CAN ALSO BE QUERIED, in this example I query the collectors nicknames.
	$collectors = $survey->collectors()->query_freeform('name=course')->get();//CHANGE the 'course' to any word you have in your own collectors
	foreach($collectors as $collector){
		var_dump($collector);
	}
}


INSERT  INTO emerald_wh.fact_surveymonkey_responses (`survey_key`,`collector_key`,`lms_rbac_user_id`,`lms_course_enrollment_id`,`lms_content_enrollment_id`,`response_key`,`response_status`,`response_start_date_id`,`response_start_time_id`,`response_end_date_id`,`response_end_time_id`,`total_seconds_on_survey`,`question_key`,`choice_key`,`row_key`,`free_text`,date_created,created_by,modified_by)
VALUES
(130702912,
 170207925,
 0,
 null,
 null,
    6698266735,
    'completed',
    20180215,
    20,
    20180215,
    20,
    48,
    260482330,
    1790294812,
    1790294808,
    null,
    NOW(),2,2)