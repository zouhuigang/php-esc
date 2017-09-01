### esc库使用说明


### 使用方法

	use package\phpesc as phpesc;
	$esc=new phpesc\Esc();

查询数据：

	curl 'localhost:9200/accounts/person/_search'  -d '
		{
		  "query" : { "match" : { "desc" : "软件" }}
		}'

esc方式：

	$esc->_search('{"query":{"match":{"desc":"软件"}}}')



新建数据：

	curl -X PUT 'localhost:9200/accounts/person/1' -d '
	{
	  "user": "张三",
	  "title": "工程师",
	  "desc": "数据库管理"
	}' 


esc方式：

	$array = array('index' => 'accounts','type' => 'person','id' => '4');
	
	$esc->create($array,'{
		  "user": "张三",
		  "title": "工程师",
		  "desc": "数据库管理"
		}');