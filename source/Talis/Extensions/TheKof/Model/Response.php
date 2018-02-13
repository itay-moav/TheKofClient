<?php namespace Talis\Extensions\TheKof;
class Model_Response extends Model_a{
	
	protected function get_client():Client_a{
		//This is not the real code, TODO implement when needed return (new SurveyMonkeyClient)->collector($this->item_data->id);
	}
	
	protected function set_if_fully_loaded(){
	    $this->is_fully_loaded = true;//It has only a full view mode
	}
}