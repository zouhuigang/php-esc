<?php

require 'vendor/autoload.php';

use package\phpesc as phpesc;


echo phpesc\Test::info();

$esc=new phpesc\Esc();


/* $array = array(
        'index' => 'db_whateat',
        'type' => 'table_goods',
		'id' => '14'
		//'goodsname'=>'耶里夏丽新疆餐厅(田林店)'
    );

print_r($esc->find($array));*/



print_r($esc->_search('{"query":{"match":{"desc":"软件"}}}'));
/*
 $array = array(
        'index' => 'accounts',
        'type' => 'person',
		'id' => '4'
		//'goodsname'=>'耶里夏丽新疆餐厅(田林店)'
	);

$esc->create($array,'{
	  "user": "张三",
	  "title": "工程师",
	  "desc": "数据库管理"
}');*/


