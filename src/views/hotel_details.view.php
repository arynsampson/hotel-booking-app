<?php


//echo 'hotel details';
$url = 'localhost'.$_SERVER['REQUEST_URI'];
$res = parse_url($url);
parse_str($res['query'], $params);

print_r($params['id']);