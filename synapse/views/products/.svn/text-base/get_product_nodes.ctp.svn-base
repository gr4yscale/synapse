<?php

$data = array();

foreach ($nodes as $node){
    $data[] = array(
        "id" => $node['Product']['id'], 
        "item_no" => $node['Product']['item_no'],
        "product_name" => $node['Product']['product_name'],
        "cost" => $node['Product']['cost'],
        "parent_id" => $node['Product']['parent_id'],
        "leaf" => $node['Product']['leaf'],
    );
}

echo '{"total": ' . $total . ', "success": ' . $success . ', "products":'. $javascript->object($data).'}'; 

?>