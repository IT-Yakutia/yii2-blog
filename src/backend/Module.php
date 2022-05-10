<?php

namespace ityakutia\blog\backend;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'ityakutia\blog\backend\controllers';
    public $defaultRoute = 'blog/index';
}