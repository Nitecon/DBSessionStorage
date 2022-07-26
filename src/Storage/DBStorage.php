<?php

/**
 * This file is part of the DBSessionStorage Module (https://github.com/Nitecon/DBSessionStorage.git)
 *
 * Copyright (c) 2013 Will Hattingh (https://github.com/Nitecon/DBSessionStorage.git)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.txt that was distributed with this source code.
 */

namespace DBSessionStorage\Storage;

use Laminas\Session\SaveHandler\DbTableGateway;
use Laminas\Session\SaveHandler\DbTableGatewayOptions;
use DBSessionStorage\SaveHandler\EncodedDbTableGateway;
use Laminas\Db\Adapter\Adapter;
use Laminas\Session\SessionManager;
use Laminas\Session\Container;

class DBStorage
{

    protected $adapter;
    protected $tblGW;
    protected $sessionConfig;
    protected $serviceConfig;

    public function __construct(Adapter $adapter, $session_config, $service_config)
    {
        $this->adapter = $adapter;
        $this->sessionConfig = $session_config;
        $this->serviceConfig = $service_config;
        $this->tblGW = new \Laminas\Db\TableGateway\TableGateway('sessions', $this->adapter);
    }

    public function setSessionStorage()
    {
        $gwOpts = new DbTableGatewayOptions();
        $gwOpts->setDataColumn('data');
        $gwOpts->setIdColumn('id');
        $gwOpts->setLifetimeColumn('lifetime');
        $gwOpts->setModifiedColumn('modified');
        $gwOpts->setNameColumn('name');


        if(isset($this->serviceConfig['base64Encode']) &&
                $this->serviceConfig['base64Encode'])
        {
            $saveHandler = new EncodedDbTableGateway($this->tblGW, $gwOpts);
        }
        else {
            $saveHandler = new DbTableGateway($this->tblGW, $gwOpts);
        }
        $sessionManager = new SessionManager();
        if ($this->sessionConfig) {
            $sessionConfig = new \Laminas\Session\Config\SessionConfig();
            $sessionConfig->setOptions($this->sessionConfig);
            $sessionManager->setConfig($sessionConfig);
        }
        $sessionManager->setSaveHandler($saveHandler);
        Container::setDefaultManager($sessionManager);
        $sessionManager->start();
    }
}//end of DBStorage
