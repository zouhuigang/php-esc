<?php
namespace package\phpesc;
use package\phpesc\LibBase;
#require(APPPATH.'\libraries\ElasticLib.php'); 

class Esc extends LibBase{
    public function find($fields = FALSE)
    {
        $this->_validate_parameters($fields); 
        $this->url_build($fields);
        $this->exec_curl('GET');
        return $this->RESPONSE;
    }
    public function create($fields = FALSE, $json = FALSE)
    {
        $this->_validate_parameters($fields);
        $this->url_build($fields);
        $this->validate_json($json);
        $this->exec_curl('POST');
            
        return $this->RESPONSE;
    }
    public function delete($fields = FALSE)
    {
        $this->_validate_parameters($fields);
        $this->url_build($fields);
        $this->exec_curl('DELETE');
            
        return $this->RESPONSE;
    }
    public function update($fields = FALSE, $json = FALSE)
    {
        $this->_validate_parameters($fields);
        $this->url_build($fields);
        $this->validate_json($json);
        $this->exec_curl('PUT');
            
        return $this->RESPONSE;
	}

	//es搜索方法
	public function _search($jsonString){
        return $this -> call('_search?',"POST",$jsonString);//用post提交raw数据
    }
}

