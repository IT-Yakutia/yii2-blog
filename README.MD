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

```json
"it-yakutia/yii2-blog": "*"
```

to the require section of your `composer.json` file.


Usage
-----
Once the extension is installed, simply add in your console config:

```php
'controllerMap' => [
    ...
    'migrate' => [
        ...
        'migrationPath' => [
            ...
            '@vendor/it-yakutia/yii2-blog/src/migrations',
            ...
        ],
    ],
],
```

And just run the command:
```sh
php yii migrate
```

Set in common config params:

```php
return [
    /* ... */
    'domain' => 'https://yourdomain.example',
];
```

Add urls in your backend project:

```php
Url::toRoute('/blog/back/index');
```

Add RBAC roles:

```
blog
```

Custom view file:

```php
'custom_view_for_modules' => [
    'article_front' => [
        'view' => '@frontend/views/front_page/view',
    ],
],
```

Add fixtures:
```sh
php yii fixture ArticleCategorySet --namespace='ityakutia\blog\tests\fixtures' --interactive=0
```