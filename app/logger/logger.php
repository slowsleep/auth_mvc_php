<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Level;

$logger = new Logger('mylogger');
$logger->pushHandler(new StreamHandler('log.txt', Level::Warning));
