<?php

use Faker\Factory;

$data = [];
$faker = Factory::create();
$params = require('_config.php');

for ($i = 0; $i < $params['articleCount']; $i++) {
    $data[] = [
        'title' => 'Article: title - ' . $faker->words($nb = rand(3, 6), $asText = true),
        'content' => 'Article Content starts here - ' . $faker->text($maxNbChars = rand(2000, 4037)),
        'photo' => 'https://picsum.photos/id/' . ($i + 1) . '/525/525/',
        'video' => '<iframe width="560" height="315" src="https://www.youtube.com/watch?v=dQw4w9WgXcQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
        'is_publish' => round(rand(2, 10) / 10, 0),
        'status' => 10,
        'created_at' => '1596539222',
        'updated_at' => '1596539222',
    ];
}

return $data;
