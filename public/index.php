<?php
require_once __DIR__ . '/../vendor/autoload.php';

$api = new \NHLSchedule\Api();
$api->dispatch();