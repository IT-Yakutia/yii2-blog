<?php


namespace ityakutia\blog;


use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->setModule('blog', 'ityakutia\blog\Module');
    }
}