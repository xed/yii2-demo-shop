<?php

namespace common\bootstrap;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use shop\services\ContactService;
use yii\base\BootstrapInterface;
use yii\caching\Cache;
use yii\mail\MailerInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        $container = \Yii::$container;

        $container->setSingleton(Client::class, function () {
            return ClientBuilder::create()->build();
        });

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail']
        ]);
    }
}