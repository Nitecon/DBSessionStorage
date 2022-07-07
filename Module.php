<?php

/**
 * This file is part of the DBSessionStorage Module (https://github.com/Nitecon/DBSessionStorage.git)
 *
 * Copyright (c) 2013 Will Hattingh (https://github.com/Nitecon/DBSessionStorage.git)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.txt that was distributed with this source code.
 */

namespace DBSessionStorage;

class Module
{

    public function onBootstrap(\Laminas\Mvc\MvcEvent $e)
    {
        $storage = $e->getApplication()->getServiceManager()->get('DBSessionStorage\Storage\DBStorage');
        $storage->setSessionStorage();
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Laminas\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
        );
    }
}//end of Module
