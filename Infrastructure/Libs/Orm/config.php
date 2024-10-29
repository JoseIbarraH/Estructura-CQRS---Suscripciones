<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/vendor/autoload.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/vendor/php-patterns/activerecord/ActiveRecord.php';

use ActiveRecord\Config;

$cfg = Config::instance();

$cfg->set_connections([
    'development' => 'mysql://root:@localhost/suscripciones'
]);

$cfg->set_default_connection('development');


