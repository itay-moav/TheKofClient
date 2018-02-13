<?php namespace Talis\Extensions\TheKof;
class Model_Response extends Model_a{
    
	protected function set_if_fully_loaded(){
	    $this->is_fully_loaded = true;//It has only a full view mode
	}
	
	/**
	 * Formats the responses into an array indexed by 
	 * question id and has the question text in it
	 * 
	 * @param Model_Survey $SurveyModel
	 * @return array
	 */
	public function get_response_with_question_text(Model_Survey $SurveyModel):array{
	   SurveyMonkeyClient::$L->debug('RAW',$this->get_raw_data());
	   return [];
	}
}