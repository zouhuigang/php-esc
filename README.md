### esc库使用说明



### 使用方法

下载

	composer require "zouhuigang/phpesc:dev-master" 
	composer remove "zouhuigang/phpesc:dev-master" //移除,但是不删除本地的库文件

想要彻底删除，可以在根目录中的composer.json将本库移除掉，然后composer update,即可删除本地库文件

使用

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