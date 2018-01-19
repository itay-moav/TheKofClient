<?php namespace Talis\Extensions\TheKof;
class Model_Survey extends Model_a{

	protected function get_client():Client_a{
		return (new SurveyMonkeyClient)->surveys($this->item_data->id);
	}
	
	protected function set_if_fully_loaded(){
		$this->is_fully_loaded = isset($this->item_data->id) && isset($this->item_data->response_count);
	}
	
	/**
	 * Get the collectors client for the current survey
	 * collectors
	 * 
	 * @param int $collector_id
	 * @return Client_Collectors
	 */
	public function collectors(int $collector_id=0):Client_Collectors{
		return $this->get_client()->collectors($collector_id);
	}
	
	/**
	 * Load the current survey details, BEAWARE - this is another request!
	 * 
	 * @return Model_Survey
	 */
	public function details():Model_Survey{
	    if(!isset($this->item_data->pages)){
	        $this->item_data = $this->get_client()->details()->get_one()->item_data;
	        $this->set_if_fully_loaded();
	    }
	    return $this;
	}
	
	/**
	 * @return string
	 */
	public function title():string{
	    return $this->item_data->title;
	}

	/**
	 * return array of the pages
	 * carefull, this is by ref
	 * 
	 * @return array
	 */
	public function pages():array{
	    return $this->details()->item_data->pages;
	}
	
	/**
	 * Returns all questions. this is a Generator
	 */
	public function all_questions(){
	    $pages = $this->details()->item_data->pages;
	    foreach($pages as $page){
	        foreach($page->questions as $question){
	            yield $question;
	        }
	    }
	}
}