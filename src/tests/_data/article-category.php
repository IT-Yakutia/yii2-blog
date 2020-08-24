<?php

use Faker\Factory;

$data = [];
$faker = Factory::create();
$params = require('_config.php');

for ($i = 0; $i < $params['articleCategoryCount']; $i++) {
    $data[] = [
        'title' => 'Thread: title - ' . $faker->words($nb = rand(3, 6), $asText = true),
        'is_publish' => round(rand(2, 10) / 10, 0),
        'status' => 10,
        'created_at' => '1581434317',
        'updated_at' => '1581434317',
    ];
}

return $data;
