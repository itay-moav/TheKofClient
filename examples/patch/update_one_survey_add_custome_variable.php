<?php
/**
 * Creating a collector for the input survey
 */
echo "Call this script as many times as you want, See the difference when u change the value of the custom variable vs, using a new custome variable name\n";
require_once '../env.php';
if(!is_numeric(Env::$survey_id_to_query)){
	echo "\nERROR!  You must put a numeric survey id in the env at Env::\$survey_monkey_config in env.php\n";
	exit;
}
if(!isset($argv[1]) || !$argv[1]){
    echo "\nYou must supply a custome variable name as a parameter.\n";
    exit;
}

if(!isset($argv[2]) || !$argv[2]){
    echo "\nYou must supply a custome variable value as a second parameter.\n";
    exit;
}

$var_name  = $argv[1];
$var_value = $argv[2];

$s_id = Env::$survey_id_to_query;
echo "\nYou are about to create a cutsome variable named [{$var_name}] with value [{$var_value}] for survey [{$s_id}]\n";


$raw_data = new \stdClass;
$raw_data->custom_variables = new stdClass;
$raw_data->custom_variables->$var_name = $var_value;

\TheKof\SurveyMonkey::init(Env::$survey_monkey_config,$http_client_wrapper);//this two params are coming from the env.php file
$update_survey = \TheKof\SurveyMonkey::surveys(Env::$survey_id_to_query)->get_one()->patch($raw_data);
var_dump($update_survey->get_raw_data());
