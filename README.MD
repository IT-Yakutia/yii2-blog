Blog module for Yii2
====================
Blog module for Yii2

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run
```sh
php composer.phar require --prefer-dist it-yakutia/yii2-blog "*"
```
or add
```json lines
"it-yakutia/yii2-blog": "*"
```
to the require section of your `composer.json` file.

Add Module in backend config `main.php`:
```php
return [
    ...
    'modules' => [
        ...
        'blog' => \ityakutia\blog\backend\Module::class,
        ...
    ],
    ...
];
```

Add Module in frontend config `main.php`:
```php
return [
    ...
    'modules' => [
        ...
        'blog' => \ityakutia\blog\frontend\Module::class,
        ...
    ],
    ...
];
```

In console config `main.php` add `migrationPath` value in `controllerMap` `migration` section:
```php
return [
    ...
    'controllerMap' => [
        ...
	    'migrate' => [
		    'class' => \yii\console\controllers\MigrateController::class,
		    'migrationPath' => [
				'@console/migrations',
				...
			    '@ityakutia/blog/migrations',
			    ...
		    ],
	    ],
    ],
```
And just run the command:
```sh
php yii migrate
```

Add in common `main.php`:
```php
return [
    ...
    'domain' => 'https://yourdomain.example',
    ...
];
```

Add urls in your backend project:
```php
Url::toRoute('/blog/back/index');
```

Usage
-----

For customizing front view add to frontend `params.php`:
```php
return [
    ...
    'custom_view_for_modules' => [
        'blog' => [
            'index' => '@frontend/views/blog/index', 
            'view' => '@frontend/views/blog/view',
        ],
    ],
    ...
];
```

Fixtures
--------

Add fixtures:
```sh
php yii fixture ArticleCategorySet --namespace='ityakutia\blog\tests\fixtures'
```

Add fixtures in docker:
```sh
php yii fixture ArticleCategorySet --namespace='ityakutia\blog\tests\fixtures' --interactive=0
```