<?php

/**
 * Copyright (c) 2013 Will Hattingh (https://github.com/Nitecon
 *
 * For the full copyright and license information, please view
 * the file LICENSE.txt that was distributed with this source code.
 * 
 * @author Will Hattingh <w.hattingh@nitecon.com>
 * @author https://github.com/acnb
 * 
 */

namespace DBSessionStorage\Factory;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use DBSessionStorage\Storage\DBStorage;

/*
 * Contributed storage factory by community user https://github.com/acnb
 */

class DBStorageFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $conf = $serviceLocator->get('Config');
        $config = null;
        $serviceConfig = null;
        
        if (isset($conf['zf2-db-session']) && isset($conf['zf2-db-session']['sessionConfig'])) {
            $config = $conf['zf2-db-session']['sessionConfig'];
        }
        
        if (isset($conf['zf2-db-session']) && isset($conf['zf2-db-session']['serviceConfig'])) {
            $serviceConfig = $conf['zf2-db-session']['serviceConfig'];
        }
        
        $dbAdapter = $serviceLocator->get('\Laminas\Db\Adapter\Adapter');
        return new DBStorage($dbAdapter, $config, $serviceConfig);
    }
}

