<?php

namespace {

    use Composer\Autoload\ClassLoader;

    if (!$loader = @include __DIR__.'/../vendor/autoload.php') {
        echo <<<'EOM'
You must set up the project dependencies by running the following commands:
curl -s http://getcomposer.org/installer | php
php composer.phar install
EOM;
        exit(1);
    }

    $classLoader = new ClassLoader();
    $classLoader->addPsr4("RocketShipIt\\", __DIR__.'/RocketShipItDummy', true);
    $classLoader->register();
}
