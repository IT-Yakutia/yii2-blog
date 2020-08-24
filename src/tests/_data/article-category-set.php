<?php

use Faker\Factory;

$data = [];
$faker = Factory::create();
$params = require('_config.php');

for ($i = 0; $i < $params['articleCategorySetCount']; $i++) {
    $data[] = [
        'article_id' => rand(1, $params['articleCount']),
        'article_category_id' => rand(1, $params['articleCategoryCount']),
    ];
}

return $data;
