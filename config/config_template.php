<?php
// candy配置文件
$candyConfig = [
	// 数据库配置
	'mysql' => [
		'host' => '{DB_HOST}',
		'port' => {DB_PORT},
		'user' => '{DB_USER}',
		'pass' => '{DB_PASS}',
		'name' => '{DB_NAME}',
        'prefix' => '{DB_PREFIX}',
	],
	// 站点名称（显示在标题和网页上）
	'sitename'           => '{SITENAME}',
	// 站点介绍（显示在网页上）
	'description'        => '{DESCRIPTION}',
];

function mysqlInfo($key,$candyConfig)
{
    return $candyConfig['mysql'][$key];
}

# I Don't Know WTF I WRITE!!!!
# Copied From ImJingLan/Dictum's Config Template LOL
# A Template Forever!!!!
# Forgive The Waring, It'll be Fine in config.php file
# BTW:F U VS Code

?>