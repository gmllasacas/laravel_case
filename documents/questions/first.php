<?php

$products = [
    ['Milk', '1.25', 2],
    ['Eggs', '4.99', 1],
    ['Granulated sugar', '1.25', 1],
    ['Broccoli', '2.34', 3],
    ['Chocolate bar', '1.25', 5],
    ['Organic All-purpose flour', '4.99', 2]
];

$sort = array();
foreach ($products as $k => $v) {
    $sort['price'][$k] = $v['1'];
    $sort['quan'][$k] = $v['2'];
}

array_multisort($sort['price'], SORT_DESC, $sort['quan'], SORT_DESC,$products);

$products = array_map(function ($product) {
    $product['3'] = $product['1'] *  $product['2'];
    return $product;
}, $products);

print_r($products);