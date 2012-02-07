<?php

$data = array();

foreach ($nodes as $node){
    $data[] = array(
        "text" => $node['ProductCategory']['category_name'], 
        "id" => $node['ProductCategory']['id'],
		"leaf" => intval($node['ProductCategory']['leaf'])
    );
}

echo $javascript->object($data);

?>