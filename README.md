DBSessionStorage
================

Zend Framework Module for storing sessions in database.

## Features
- Easy to use module for getting your sessions into a database
- Uses Zend\Session\SaveHandler\DbTableGateway
- Uses your already available DB Configuration

## Setup

The following steps are necessary to get this module working

  1. Run `php composer.phar require nitecon/zf2-db-session:1.*`
  2. Add `DBSessionStorage` to the enabled modules list
  3. Add the sessions table to your database with:
    <pre class="brush:mysql">
    CREATE TABLE IF NOT EXISTS `sessions` (
        `id` char(32) NOT NULL DEFAULT '',
        `name` varchar(255) NOT NULL,
        `modified` int(11) DEFAULT NULL,
        `lifetime` int(11) DEFAULT NULL,
        `data` text,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
      </pre>

## Addditional Information

This module assumes that you already have a top level *db* key in your configuration like the following:
<pre class="brush:php">
    return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=somedb;host=localhost',
        'username' => 'sessionuser',
        'password' => 'sessionpass',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
            'buffer_results' => true
        ),
    ),
    /* Rest of your config */
    );
</pre>

If you do not have this configuration please make sure to add it based on your database details, and always
remember to put your username and password details in the local.php file so that it is not added
to the revision control system that you use.

## Final notes

Please note that the driver as listed above does not need to be Pdo it can be anything that Zend Adapter
supports, however it has only been tested with a Pdo / Mysqli driver.

I'm also planning on adding another module for doctrine based database interface in the future for those
that are interested.

Enjoy and if you find bugs or issues please add pull requests for the module.

