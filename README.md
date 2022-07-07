DBSessionStorage
================

Zend Framework Module for storing sessions in database.

## Features
- Easy to use module for getting your sessions into a database
- Uses Laminas\Session\SaveHandler\DbTableGateway
- Uses your already available DB Configuration
- Provides configurable session options

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
  4. Copy `vendor/nitecon/zf2-db-session/dbsession.global.php.dist` to `config/autoload/dbsession.global.php` 
  5. Configure the session options in `config/autoload/dbsession.global.php`

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

## Gotchas and Errors

If you see the error that looks something like: Laminas\Session\SessionManager 'Insufficient data for unserializing'
It means that the data being inserted into the database is larger than what the column allows for it.

To fix this issue adjust the 'data' column in your database from 'text' -> 'blob', On some of my applications that
store a good amount of data in the session I've noticed that with some ZF2 overhead on the session they are generally
around 1.5kb in size which generates this error.

## Final notes

Please note that the driver as listed above does not need to be Pdo it can be anything that Zend Adapter
supports, however it has only been tested with a Pdo / Mysqli driver.

I'm also planning on adding another module for doctrine based database interface in the future for those
that are interested.

Enjoy and if you find bugs or issues please add pull requests for the module.

