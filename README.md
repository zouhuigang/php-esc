## 如何创建一个自己的 Composer/Packagist 包

自己新建一个composer.json,内容参考本库:

		{
	    "name": "zouhuigang/phpesc",
	    "description": "php esc search",
	    "license": "MIT",
	    "authors": [
	        {
	            "name": "zouhuigang",
	            "email": "952750120@qq.com"
	        }
	    ],
	    "minimum-stability": "dev",
	    "require": {
	        "php": ">=5.3.0"
	    },
	    "autoload": {
	        "psr-4": {
	            "package\\phpesc\\": "src/package/phpesc"
	        }
	    }	
	}

安装它很简单在包的root目录下install即可：
 
    composer install

闪过几行神秘的提示之后即安装完毕，此时会在vendor/composer/autoload_psr4.php中生成命名空间和目录的映射关系，被包在一个数组中：

    <?php

	$vendorDir = dirname(dirname(__FILE__));
	$baseDir = dirname($vendorDir);
	
	return array(
	    'package\\phpesc\\' => array($vendorDir . '/zouhuigang/phpesc/src/package/phpesc'),
	    'QL\\Ext\\Lib\\' => array($vendorDir . '/jaeger/curlmulti', $vendorDir . '/jaeger/http'),
	    'QL\\Ext\\' => array($vendorDir . '/jaeger/querylist-ext-aquery', $vendorDir . '/jaeger/querylist-ext-multi', $vendorDir . '/jaeger/querylist-ext-request', $vendorDir . '/jaeger/querylist-ext-login'),
	    'QL\\' => array($vendorDir . '/jaeger/querylist'),
	    'LeanCloud\\' => array($vendorDir . '/leancloud/leancloud-sdk/src/LeanCloud'),
	);

如果发布成packagist包然后进行安装的话，到时候这里就不是$baseDir了而是$vendorDir。



然后我们新建一个测试文件show.php，用以下内容填充它：

	<?php
	
	require 'vendor/autoload.php';
	
	use package\phpesc as phpesc;
	
	
	echo phpesc\Test::info();


打开浏览器敲入 `http://localhost/show.php` (localhost是我的本地测试域名，请替换成小伙伴自己的)。

浏览器上依次输出了：
	
	hello zouhuigang package phpesc



如果库文件的代码变更了，使用：

	composer update #更新本库







   